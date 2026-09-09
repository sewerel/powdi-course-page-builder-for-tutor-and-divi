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



    const preview = attrs?.module?.advanced?.preview?.desktop?.value ?? 'auto';
    const [isLoading, setIsLoading] = useState(false);
    const [html, setHtml] = useState('');
    console.log('Button: ', attrs)

    useEffect(() => {
        setIsLoading(true);
        Ajax(preview).then(response => {
            setIsLoading(false);
            if (response.html) {
                setHtml(response.html);
            }
        })
    }, [preview]);

    return (
        <ModuleContainer
            attrs={attrs}
            elements={elements}
            id={id}
            moduleClassName="divi_tutor_course_button"
            name={name}
            scriptDataComponent={ModuleScriptData}
            stylesComponent={ModuleStyles}
            classnamesFunction={moduleClassnames}
        >
            {isLoading && <div class="et-vb-loader"></div>}
            {!isLoading && <span dangerouslySetInnerHTML={{ __html: html }}></span>}

        </ModuleContainer >
    )

};
export default render;