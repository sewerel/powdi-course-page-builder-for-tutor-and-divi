// External Dependencies
import React, { Component } from 'react';
import './style.css';


class DTUTCourseContent extends Component {

    static slug = 'divi_tutor_course_content';
    static css(props) {
        const classes = {
            main: '%%order_class%% .tutor-accordion',
            header: '.tutor-accordion-item-header',
            lesson: '.tutor-course-content-list-item',
            info: '.tutor-course-content-list-item-duration',
            lessonIcon1: '.tutor-course-content-list-item-icon',
            lessonIcon2: '.tutor-course-content-list-item-status'
        }
        const isTablet = window.ET_Builder.API.State['View_Mode'].isTablet();
        const isPhone = window.ET_Builder.API.State['View_Mode'].isPhone();
        const suffix = isTablet ? '_tablet' : isPhone ? '_phone' : false;
        const css = [];
        //remove_divider
        if (props.remove_divider && props.remove_divider === 'on') {

            css.push([{
                selector: `${classes.main} .tutor-accordion-item-body-content`,
                declaration: 'border-top:none!important;'
            }]);
        }
        //topic_padding
        if (props.topic_padding) {
            const topic_padding = props.topic_padding.split('|');
            css.push([{
                selector: `${classes.main} ${classes.header}`,
                declaration: `padding-top: ${topic_padding[0]};padding-right: ${topic_padding[1]};padding-bottom: ${topic_padding[2]};padding-left: ${topic_padding[3]};`
            }]);
        }
        if (suffix && props['topic_padding' + suffix]) {
            const topic_padding_tablet = props['topic_padding' + suffix].split('|');
            css.push([{
                selector: `${classes.main} ${classes.header}`,
                declaration: `padding-top: ${topic_padding_tablet[0]};padding-right: ${topic_padding_tablet[1]};padding-bottom: ${topic_padding_tablet[2]};padding-left: ${topic_padding_tablet[3]};`,
            }]);
        }
        //lesson_padding
        if (props.lesson_padding) {
            const lesson_padding = props.lesson_padding.split('|');
            css.push([{
                selector: `${classes.main} ${classes.lesson}`,
                declaration: `padding-top: ${lesson_padding[0]};padding-right: ${lesson_padding[1]};padding-bottom: ${lesson_padding[2]};padding-left: ${lesson_padding[3]};`
            }]);
        }
        if (suffix && props['lesson_padding' + suffix]) {
            const lesson_padding_tablet = props['lesson_padding' + suffix].split('|');
            css.push([{
                selector: `${classes.main} ${classes.lesson}`,
                declaration: `padding-top: ${lesson_padding_tablet[0]};padding-right: ${lesson_padding_tablet[1]};padding-bottom: ${lesson_padding_tablet[2]};padding-left: ${lesson_padding_tablet[3]};`,
            }]);
        }
        //open_padding
        if (props.open_padding) {
            const open_padding = props.open_padding.split('|');
            css.push([{
                selector: `${classes.main} .tutor-accordion-item-body-content`,
                declaration: `padding-top: ${open_padding[0]};padding-right: ${open_padding[1]};padding-bottom: ${open_padding[2]};padding-left: ${open_padding[3]};`
            }]);
        }
        if (suffix && props['open_padding' + suffix]) {
            const open_padding_tablet = props['open_padding' + suffix].split('|');
            css.push([{
                selector: `${classes.main} .tutor-accordion-item-body-content`,
                declaration: `padding-top: ${open_padding_tablet[0]};padding-right: ${open_padding_tablet[1]};padding-bottom: ${open_padding_tablet[2]};padding-left: ${open_padding_tablet[3]};`,
            }]);
        }
        //topic_icon_size
        if (props.topic_icon_size) {
            const topic_icon_size = props.topic_icon_size;
            css.push([{
                selector: `${classes.main} ${classes.header}:after`,
                declaration: `font-size: ${topic_icon_size};`
            }]);
        }
        if (suffix && props['topic_icon_size' + suffix]) {
            const topic_icon_size_tablet = props['topic_icon_size' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.header}:after`,
                declaration: `font-size: ${topic_icon_size_tablet};`,
            }]);

        }
        //topic_icon_color
        if (props.topic_icon_color) {
            const topic_icon_color = props.topic_icon_color;
            css.push([{
                selector: `${classes.main} ${classes.header}:after`,
                declaration: `color: ${topic_icon_color};`
            }]);
        }
        if (suffix && props['topic_icon_color' + suffix]) {
            const topic_icon_color_tablet = props['topic_icon_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.header}:after`,
                declaration: `color: ${topic_icon_color_tablet};`,
            }]);
        }
        //topic_text_color
        if (props.topic_text_color) {
            const topic_text_color = props.topic_text_color;
            css.push([{
                selector: `${classes.main} ${classes.header}`,
                declaration: `color: ${topic_text_color};`
            }]);
        }
        if (suffix && props['topic_text_color' + suffix]) {
            const topic_text_color_tablet = props['topic_text_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.header}`,
                declaration: `color: ${topic_text_color_tablet};`,
            }]);
        }
        //topic_backkground_color
        if (props.topic_backkground_color) {
            const topic_backkground_color = props.topic_backkground_color;
            css.push([{
                selector: `${classes.main} ${classes.header}`,
                declaration: `background-color: ${topic_backkground_color};`
            }]);
        }
        if (suffix && props['topic_backkground_color' + suffix]) {
            const topic_backkground_color_tablet = props['topic_backkground_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.header}`,
                declaration: `background-color: ${topic_backkground_color_tablet};`,
            }]);
        }
        //topic_icon_active_color
        if (props.topic_icon_active_color) {
            const topic_icon_active_color = props.topic_icon_active_color;
            css.push([{
                selector: `${classes.main} ${classes.header}.is-active:after`,
                declaration: `color: ${topic_icon_active_color};`
            }]);
        }
        if (suffix && props['topic_icon_active_color' + suffix]) {
            const topic_icon_active_color_tablet = props['topic_icon_active_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.header}.is-active:after`,
                declaration: `color: ${topic_icon_active_color_tablet};`,
            }]);
        }
        //topic_text_active_color
        if (props.topic_text_active_color) {
            const topic_text_active_color = props.topic_text_active_color;
            css.push([{
                selector: `${classes.main} ${classes.header}.is-active`,
                declaration: `color: ${topic_text_active_color};`
            }]);
        }
        if (suffix && props['topic_text_active_color' + suffix]) {
            const topic_text_active_color_tablet = props['topic_text_active_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.header}.is-active`,
                declaration: `color: ${topic_text_active_color_tablet};`,
            }]);
        }
        //topic_background_active_color
        if (props.topic_background_active_color) {
            const topic_background_active_color = props.topic_background_active_color;
            css.push([{
                selector: `${classes.main} ${classes.header}.is-active`,
                declaration: `background-color: ${topic_background_active_color};`
            }]);
        }
        if (suffix && props['topic_background_active_color' + suffix]) {
            const topic_background_active_color_tablet = props['topic_background_active_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.header}.is-active`,
                declaration: `background-color: ${topic_background_active_color_tablet};`,
            }]);
        }
        //topic_icon_hover_color
        if (props.topic_icon_hover_color) {
            const topic_icon_hover_color = props.topic_icon_hover_color;
            css.push([{
                selector: `${classes.main} ${classes.header}:hover:after`,
                declaration: `color: ${topic_icon_hover_color};`
            }]);
        }
        if (suffix && props['topic_icon_hover_color' + suffix]) {
            const topic_icon_hover_color_tablet = props['topic_icon_hover_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.header}:hover:after`,
                declaration: `color: ${topic_icon_hover_color_tablet};`,
            }]);
        }
        //topic_text_hover_color
        if (props.topic_text_hover_color) {
            const topic_text_hover_color = props.topic_text_hover_color;
            css.push([{
                selector: `${classes.main} ${classes.header}:hover`,
                declaration: `color: ${topic_text_hover_color};`
            }]);
        }
        if (suffix && props['topic_text_hover_color' + suffix]) {
            const topic_text_hover_color_tablet = props['topic_text_hover_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.header}:hover`,
                declaration: `color: ${topic_text_hover_color_tablet};`,
            }]);
        }
        //topic_background_hover_color
        if (props.topic_background_hover_color) {
            const topic_background_hover_color = props.topic_background_hover_color;
            css.push([{
                selector: `${classes.main} ${classes.header}:hover`,
                declaration: `background-color: ${topic_background_hover_color};`
            }]);
        }
        if (suffix && props['topic_background_hover_color' + suffix]) {
            const topic_background_hover_color_tablet = props['topic_background_hover_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.header}:hover`,
                declaration: `background-color: ${topic_background_hover_color_tablet};`,
            }]);
        }
        //lesson_icon_size
        if (props.lesson_icon_size) {
            const lesson_icon_size = props.lesson_icon_size;
            css.push([{
                selector: `${classes.main} ${classes.lessonIcon1},${classes.main} ${classes.lessonIcon2}`,
                declaration: `font-size: ${lesson_icon_size};`
            }]);
        }
        if (suffix && props['lesson_icon_size' + suffix]) {
            const lesson_icon_size_tablet = props['lesson_icon_size' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.lessonIcon1},${classes.main} ${classes.lessonIcon2}`,
                declaration: `font-size: ${lesson_icon_size_tablet};`,
            }]);
        }
        //lesson_icon_color
        if (props.lesson_icon_color) {
            const lesson_icon_color = props.lesson_icon_color;
            css.push([{
                selector: `${classes.main} ${classes.lessonIcon1},${classes.main} ${classes.lessonIcon2}`,
                declaration: `color: ${lesson_icon_color};`
            }]);
        }
        if (suffix && props['lesson_icon_color' + suffix]) {
            const lesson_icon_color_tablet = props['lesson_icon_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.lessonIcon1},${classes.main} ${classes.lessonIcon2}`,
                declaration: `color: ${lesson_icon_color_tablet};`,
            }]);
        }
        //lesson_icon_color__hover
        if (props.lesson_icon_color__hover) {
            const lesson_icon_color__hover = props.lesson_icon_color__hover;
            css.push([{
                selector: `${classes.main} ${classes.lesson}:hover ${classes.lessonIcon1},${classes.main} ${classes.lesson}:hover ${classes.lessonIcon2}`,
                declaration: `color: ${lesson_icon_color__hover};`
            }]);
        }
        if (suffix && props['lesson_icon_color__hover' + suffix]) {
            const lesson_icon_color__hover_tablet = props['lesson_icon_color__hover' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.lesson}:hover ${classes.lessonIcon1},${classes.main} ${classes.lesson}:hover ${classes.lessonIcon2}`,
                declaration: `color: ${lesson_icon_color__hover_tablet};`,
            }]);
        }
        //lesson_background_color
        if (props.lesson_background_color) {
            const lesson_background_color = props.lesson_background_color;
            css.push([{
                selector: `${classes.main} ${classes.lesson}`,
                declaration: `background-color: ${lesson_background_color};`
            }]);
        }
        if (suffix && props['lesson_background_color' + suffix]) {
            const lesson_background_color_tablet = props['lesson_background_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.lesson}`,
                declaration: `background-color: ${lesson_background_color_tablet};`,
            }]);
        }
        //lesson_background_color__hover
        if (props.lesson_background_color__hover) {
            const lesson_background_color__hover = props.lesson_background_color__hover;
            css.push([{
                selector: `${classes.main} ${classes.lesson}:hover`,
                declaration: `background-color: ${lesson_background_color__hover};`
            }]);
        }
        if (suffix && props['lesson_background_color__hover' + suffix]) {
            const lesson_background_color__hover_tablet = props['lesson_background_color__hover' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.lesson}:hover`,
                declaration: `background-color: ${lesson_background_color__hover_tablet};`,
            }]);
        }
        //lesson_info_color
        if (props.lesson_info_color) {
            const lesson_info_color = props.lesson_info_color;
            css.push([{
                selector: `${classes.main} ${classes.info}`,
                declaration: `color: ${lesson_info_color};`
            }]);
        }
        if (suffix && props['lesson_info_color' + suffix]) {
            const lesson_info_color_tablet = props['lesson_info_color' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.info}`,
                declaration: `color: ${lesson_info_color_tablet};`,
            }]);
        }
        //lesson_info_color__hover
        if (props.lesson_info_color__hover) {
            const lesson_info_color__hover = props.lesson_info_color__hover;
            css.push([{
                selector: `${classes.main} ${classes.lesson}:hover ${classes.info}`,
                declaration: `color: ${lesson_info_color__hover};`
            }]);
        }
        if (suffix && props['lesson_info_color__hover' + suffix]) {
            const lesson_info_color__hover_tablet = props['lesson_info_color__hover' + suffix];
            css.push([{
                selector: `${classes.main} ${classes.lesson}:hover ${classes.info}`,
                declaration: `color: ${lesson_background_color__hover_tablet};`,
            }]);
        }
        //space_between_topics
        if (props.space_between_topics) {
            const space_between_topics = props.space_between_topics;
            css.push([{
                selector: `${classes.main} .tutor-accordion-item:nth-last-child(n+2)`,
                declaration: `margin-bottom: ${space_between_topics};`
            }]);
        }
        if (suffix && props['space_between_topics' + suffix]) {
            const space_between_topics_tablet = props['space_between_topics' + suffix];
            css.push([{
                selector: `${classes.main} .tutor-accordion-item:nth-last-child(n+2)`,
                declaration: `margin-bottom: ${space_between_topics_tablet};`,
            }]);
        }

        return css;
    }



    /**
     * Render component output
     *
     * @return {string|React.Component|React.component[]}
     */
    render() {

        return (

            <div dangerouslySetInnerHTML={{ __html: this.props.__html }} />
        );
    }
}

export default DTUTCourseContent;
