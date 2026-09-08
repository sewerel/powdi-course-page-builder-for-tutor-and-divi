// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
//import './style.css';


class DTUTCourseStatus extends Component {

    static slug = 'divi_tutor_course_status';

    static css(props) {
        const isTablet = window.ET_Builder.API.State['View_Mode'].isTablet();
        const isPhone = window.ET_Builder.API.State['View_Mode'].isPhone();
        const suffix = isTablet ? '_tablet' : isPhone ? '_phone' : false;
        const classes = {
            bar: '%%order_class%% .divi-tutor-progress-bar',
            progress: '%%order_class%% .divi-tutor-progress-line',
        };
        const css = [];
        //progress thickness
        if (props.thickness) {
            const thickness = props.thickness;
            css.push([{
                selector: `${classes.bar}, ${classes.progress}`,
                declaration: `height: ${thickness};`
            }]);
        }
        if (suffix && props['thickness' + suffix]) {
            const thickness_tablet = props['thickness' + suffix];
            css.push([{
                selector: `${classes.bar}, ${classes.progress}`,
                declaration: `height: ${thickness_tablet};`
            }]);
        }
        //progress color
        if (props.progress_color) {
            const progress_color = props.progress_color;
            css.push([{
                selector: `${classes.progress}`,
                declaration: `background-color: ${progress_color};`
            }]);
        }
        if (suffix && props['progress_color' + suffix]) {
            const progress_color_tablet = props['progress_color' + suffix];
            css.push([{
                selector: `${classes.progress}`,
                declaration: `background-color: ${progress_color_tablet};`
            }]);
        }
        //progress background
        if (props.progress_background) {
            const progress_background = props.progress_background;
            css.push([{
                selector: `${classes.bar}`,
                declaration: `background-color: ${progress_background};`
            }]);
        }
        if (suffix && props['progress_background' + suffix]) {
            const progress_background_tablet = props['progress_background' + suffix];
            css.push([{
                selector: `${classes.bar}`,
                declaration: `background-color: ${progress_background_tablet};`
            }]);
        }

        return css;
    }

    render() {
        return (
            <div dangerouslySetInnerHTML={{ __html: this.props.__html }} />
        );
    }
}

export default DTUTCourseStatus;