// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
//import './style.css';


class DTUTCoursePrice extends Component {

    static slug = 'divi_tutor_course_price';
    render() {
        return (
            <div dangerouslySetInnerHTML={{ __html: this.props.__html }} />
        );
    }
}

export default DTUTCoursePrice;