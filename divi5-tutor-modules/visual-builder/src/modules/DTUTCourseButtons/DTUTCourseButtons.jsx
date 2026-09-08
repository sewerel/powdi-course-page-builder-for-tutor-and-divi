// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
//import './style.css';


class DTUTCourseButtons extends Component {

    static slug = 'divi_tutor_course_button';

    static css(props) {
        const isTablet = window.ET_Builder.API.State['View_Mode'].isTablet();
        const isPhone = window.ET_Builder.API.State['View_Mode'].isPhone();
        const suffix = isTablet ? '_tablet' : isPhone ? '_phone' : false;
        const css = [];

        return css;
    }

    render() {
        return (
            <div dangerouslySetInnerHTML={{ __html: this.props.__html }} />
        );
    }
}

export default DTUTCourseButtons;