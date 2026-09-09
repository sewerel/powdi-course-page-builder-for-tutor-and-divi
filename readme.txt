=== Powdi Course Page Builder for Tutor and Divi ===
Contributors: sewerel
Tags: tutor lms, divi, course builder, page builder
Requires at least: 5.0
Tested up to: 7.1
Stable tag: 1.1.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Powdi Course Page Builder for Tutor and Divi lets you create beautiful, responsive course pages using the Divi Builder and Tutor LMS course data.

== Description ==

**Design Your Tutor LMS Course Pages with Divi 4 or Divi 5 – The Way You Want.**

By default, Tutor LMS controls your course page. It renders its own template — sidebar entry box, tabs, and page wrapper — leaving you little room to design the page the way the rest of your Divi site looks.

**Course Page Builder for Tutor and Divi** hands that control back to you.

This free plugin switches off Tutor LMS's default course page template and lets you rebuild the page entirely in the Divi Builder — then place the Tutor course elements back exactly where you want them. On **Divi 5**, drag in the native Course Buttons, Course Content, Course Price, and Course Progress modules; on **Divi 4**, or anywhere shortcodes are accepted, use the included shortcodes instead.

Perfect for course creators, designers, and developers who want their Tutor LMS course pages to feel like a real part of their site — not a default template dropped in the middle of it.

= How It Works =

It's designed to be simple — there's nothing to configure:

* **Just activate the plugin** — as soon as it's active, Tutor LMS's default course page template is switched off automatically. You're left with a clean, blank course page, fully under your control in Divi.
* **Add the shortcodes, or the native Divi 5 modules,** where you want the Tutor course elements to appear in your Divi layout.
* **To restore the default Tutor LMS layout**, simply deactivate the plugin. The change is completely reversible — deactivating brings back Tutor's standard course page exactly as before.

= What This Free Plugin Does =

* **Disables Tutor LMS's default course page template** — the sidebar entry box, tabs, and page wrapper Tutor normally builds for you.
* **Provides shortcodes** to place Tutor's course price/progress/enroll card, or just the action button on its own, anywhere inside your Divi design.
* **Leaves Tutor's lesson player and dashboard pages untouched** — only the main course page template is handed back to Divi.

= Native Divi 5 Modules =

If you're on Divi 5, these appear directly in the Visual Builder's module library once Tutor LMS and Divi 5 are both active — no shortcode needed:

* **Divi Tutor Course Buttons** — the enroll/purchase/continue action button.
* **Divi Tutor Course Content** — the lessons, topics, and quizzes curriculum accordion.
* **Divi Tutor Course Price** — the course price (or a "Free" label).
* **Divi Tutor Course Progress** — the enrolled user's progress bar.

On Divi 4, use the shortcodes below instead.

= Included Shortcodes =

Drop these into a Divi Code module (or anywhere shortcodes are accepted) to display the Tutor LMS elements within your own design:

* `[powdcotu_course_infobar]` — displays Tutor's course entry box: price/purchase button, enrollment status, progress bar, and course meta (level, duration, enrolled count).
* `[powdcotu_course_action_button]` — displays only the enroll/purchase action button (Continue Learning, Start Learning, Add to Cart, or Enroll Now, depending on the visitor's enrollment status and the course's pricing).
* `[powdcotu_course_content]` — displays Tutor's course curriculum accordion (topics, lessons, and quizzes, with lock icons for content the visitor can't yet access).

**A note on styling:** the shortcodes output Tutor LMS's own markup and CSS classes, so they inherit Tutor's default styling out of the box. You can restyle them to match your site using your own CSS or Divi's design options.

The `[powdcotu_course_infobar]` and `[powdcotu_course_action_button]` shortcodes also accept two optional attributes to quickly recolor/resize the action button without writing CSS:

* `btn_color` — a hex color (`#e91e63`), a CSS color keyword (`red`), or an `rgb()`/`rgba()`/`hsl()`/`hsla()` value.
* `btn_width` — a CSS length (`300px`, `100%`, `20em`) or `auto`.

For example: `[powdcotu_course_action_button btn_color="#e91e63" btn_width="100%"]`. Any value that doesn't match one of these formats is ignored and the button falls back to its default styling.

= Actively Developed =

This is an early version, and the plugin is actively developed. Native Divi 5 modules now ship for Course Buttons, Course Content, Course Price, and Course Progress. Your feedback is welcome and helps shape what comes next.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/powdi-course-page-builder-for-tutor-and-divi` directory, or install the plugin through the WordPress plugins screen.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Divi Builder on a page and use the shortcodes in a code or text module.

== Frequently Asked Questions ==

= Does this work with Divi 5? =

Yes. Course Page Builder for Tutor and Divi works with both Divi 4 and Divi 5. On Divi 5 you also get native Course Buttons, Course Content, Course Price, and Course Progress modules in the Visual Builder.

= Do I need to use the shortcodes if I'm on Divi 5? =

No. The shortcodes still work everywhere (and are the only option on Divi 4), but on Divi 5 you can drag in the native modules directly instead — no shortcode needed.

= I have the theme divi-tutor-theme and this plugin both active — will the modules conflict? =

No. This plugin detects when the divi-tutor-theme is already providing these modules and automatically steps aside, so nothing is registered twice.

= What happens as soon as I activate the plugin? =

Activating the plugin immediately switches off Tutor LMS's default course page template. There's nothing else to configure — you're left with a blank course page to design in Divi.

= How do I get the default Tutor LMS layout back? =

Just deactivate the plugin. The change is fully reversible — deactivating restores Tutor's standard course page exactly as it was before.

= How do I show the Tutor LMS elements again after activating? =

Use the included shortcodes (`[powdcotu_course_infobar]`, `[powdcotu_course_action_button]`, and `[powdcotu_course_content]`) to place the course elements wherever you want in your Divi layout.

= Do I need a specific theme to use this plugin? =

No. This free plugin works on its own with any Divi setup and Tutor LMS.

= Does it require Divi? =

Yes. You need the Divi theme (or the Divi Builder) and Tutor LMS installed for this plugin to work.

== Documentation ==

If you have any questions about this plugin, please check the FAQ section or post a thread in the WordPress.org forum. Please search existing threads before starting a new one.

== Changelog ==

= 1.1.0 =

* 4 new native Divi 5 modules: Course Buttons, Course Content, Course Price, Course Progress
* Plugin bootstrap converted to a class-based structure

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.1.0 =
Adds 4 native Divi 5 modules (Course Buttons, Course Content, Course Price, Course Progress). Existing Divi 4 shortcodes are unchanged.

= 1.0.0 =
Initial release.