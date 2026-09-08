import React, { useEffect, useState } from 'react';
import ModuleStyles from './ModuleStyles.jsx';
import Ajax from './ajax.jsx';


const {
    ModuleContainer,
    elementClassnames
} = window?.divi?.module;

const ModuleScriptData = ({
    elements,
}) => (
    <React.Fragment>
        {elements.scriptData({
            attrName: 'module',
        })}
    </React.Fragment>
);

/**
 * Function for registering module classnames.
 */
const moduleClassnames = ({
    classnamesInstance,
    attrs,
}) => {

    // Add element classnames.
    classnamesInstance.add(
        elementClassnames({
            attrs: attrs?.module?.decoration ?? {},
        }),
    );
}
const render = (props) => {
    const {
        attrs,
        id,
        name,
        elements,
    } = props;



    const [isLoading, setIsLoading] = useState(false);
    const [html, setHtml] = useState('');
    //console.log(attrs)

    useEffect(() => {
        setIsLoading(true);
        Ajax().then(response => {
            setIsLoading(false);
            if (response.html) {
                setHtml(response.html);
            }
        })
    }, []);

    return (
        <ModuleContainer
            attrs={attrs}
            elements={elements}
            id={id}
            moduleClassName="divi_tutor_course_status"
            name={name}
            scriptDataComponent={ModuleScriptData}
            stylesComponent={ModuleStyles}
            classnamesFunction={moduleClassnames}
        >
            {isLoading && <div class="et-vb-loader"></div>}
            {!isLoading && <div dangerouslySetInnerHTML={{ __html: html }}></div>}

        </ModuleContainer >
    )

};
export default render;