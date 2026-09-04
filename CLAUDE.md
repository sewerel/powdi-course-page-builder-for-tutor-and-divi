# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A WordPress plugin that lets site builders lay out Tutor LMS course pages with the Divi Builder instead of Tutor's default course page template. It has no build step, no PHP autoloading (via Composer), and no test suite. It's a fresh port of a sibling plugin (`powdi-course-page-builder-for-learndash-and-divi`) built for LearnDash instead of Tutor LMS — the two are independent codebases with no shared code, just parallel implementations of the same idea for different LMS plugins.

The main file, `powdi-course-page-builder-for-tutor-and-divi.php`, is a thin bootstrap: plugin header, `POWDCOTU_PATH`/`POWDCOTU_URL` constants, and three `require_once`s into `includes/`. All real logic lives there:

- **`includes/disable-content.php`** — bypasses Tutor LMS's own single-course template. Tutor core hooks `template_include` for the course post type at priority 99 (`TUTOR\Template::load_single_course_template`); this plugin hooks the same filter at priority **100** so it wins, handing the theme's normal single-post template back to WordPress (via `get_single_template()`) so a Divi-built page layout renders instead. It bails early on `?subpage=` requests so Tutor's own learning-area (lesson player/dashboard) template is left untouched.
- **`includes/shortcodes.php`** — three shortcodes so the suppressed page pieces can be re-inserted manually inside a Divi Code/Text module:
  - `[powdcotu_course_infobar]` — Tutor's course entry box (price/purchase button, enrollment status, progress bar, course meta), rendered via `tutor_load_template('single.course.course-entry-box')`.
  - `[powdcotu_course_action_button]` — just the enroll/purchase button, hand-assembled from the same enrolled/public/purchasable/free branching logic Tutor core's `course-entry-box.php` template uses internally (Tutor has no single reusable "just give me the button" function the way LearnDash's `learndash_payment_buttons()` does).
  - `[powdcotu_course_content]` — the course curriculum accordion (topics/lessons/quizzes with lock icons), rendered via `tutor_load_template('single.course.course-topics')`. Note: Tutor's own `templates/single/course/course-content.php` is a misleadingly-named file that actually renders the "About Course" description text, not the curriculum — `course-topics.php` is the real curriculum template.
  - The infobar and action-button shortcodes both accept optional `btn_color`/`btn_width` attributes, sanitized by `powdcotu_sanitize_btn_color()`/`powdcotu_sanitize_btn_width()` (whitelist-only: hex/keyword/rgb()/rgba()/hsl()/hsla() colors, CSS lengths or `auto`) and applied as `--btn-color`/`--btn-width` inline custom properties via `powdcotu_wrap_shortcode_output()`.
  - All three shortcodes wrap their output in `<div class="powdcotu_shortcode_wrapper">` (empty string in, empty string out — no wrapper when a guard clause bails).
- **`includes/enqueue.php`** — enqueues `assets/css/style.css` on `wp_enqueue_scripts`, only when `is_singular(tutor()->course_post_type)` (the only place these shortcodes can render).

A recurring implementation detail worth knowing before touching `course-entry-box.php`/`course-topics.php` integration: both Tutor templates read `global $is_enrolled;` as their first statement. `tutor_load_template()`'s own `extract($variables, EXTR_SKIP)` happens in a different scope and is irrelevant here — `$is_enrolled` must be set as a true PHP global by the calling shortcode *before* calling `tutor_load_template()`, not passed via the `$variables` array.

## Working in this codebase

- There is no PHP dependency manager, build tool, linter, or automated test suite configured. Verify changes by activating the plugin on a real WordPress + Tutor LMS + Divi install (this repo's dev install lives at `D:\projects\tutor`) and checking a course page, both logged out and as an enrolled user.
- Because the shortcode handlers and the template bypass call internal Tutor LMS functions/templates directly (not through a documented public API), a Tutor LMS core update can change those file paths/function signatures/hook priorities — when editing, re-check the equivalent logic in the active Tutor version's `templates/single/course/course-entry-box.php`, `templates/single/course/course-topics.php`, and `classes/Template.php`.
- The `Prefix: powdcotu` plugin header and the `powdcotu_` function/hook prefix are this project's naming convention — keep any new functions/shortcodes/hooks under that prefix. Two known, deliberately-justified exceptions exist (see the `phpcs:ignore` comments in `includes/shortcodes.php`): the `global $is_enrolled` variable (must match Tutor core's own global) and the `apply_filters('tutor_alter_enroll_status', ...)`/`apply_filters('tutor_course_sell_by', ...)` calls (invoking Tutor core's existing filters, not defining new ones).
- This plugin was checked against the official WordPress.org [Plugin Check](https://wordpress.org/plugins/plugin-check/) tool (`wp plugin check <slug>` via WP-CLI) with zero errors/warnings remaining. Re-run it after any change that touches superglobals, hook/variable naming, or `readme.txt` headers, before assuming the change is WP.org-submission-ready.

## Release tooling (Node scripts, dev-only — not part of the plugin runtime)

- `node ready.js` — packages the plugin into a zip (via `archiver`) at `D:/plugins/<dirname>.zip`, excluding `node_modules`, the release scripts themselves, `.git`, JSON files, and `.jsx` files; also copies `changelog.txt` to `D:/plugins/changelog-<dirname>-v<version>.txt`, with the version read from the `Version:` header in the main plugin PHP file. Writes outside the repo to a hardcoded `D:/plugins` path — only meaningful on the original maintainer's machine.
- `node trunk.js` — copies the plugin (minus dev tooling files) into a local WordPress.org SVN trunk working copy at a hardcoded `D:/wporg/<dirname>/trunk` path.
- **`bump.js` is not present in this repo** (unlike the sibling LearnDash plugin, which has one). `changelog.txt` exists and follows the same format `bump.js` produces elsewhere in this maintainer's projects (`## [version] – date` header, `### 🚀 New Features`/`### 🛠 Improvements`/`### 🐛 Bug Fixes` sections, `- ` bullets) — until `bump.js` is added here, version bumps in the plugin header and new changelog entries need to be done by hand, kept in sync with each other.

`readme.txt` follows the standard WordPress.org plugin readme format (`=== Header ===`, `== Description ==`, etc.) and should stay in sync with the plugin header in the main PHP file (version, tested-up-to, description, shortcode list) when any of those change.
