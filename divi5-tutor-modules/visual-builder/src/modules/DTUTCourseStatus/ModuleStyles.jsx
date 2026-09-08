const {
    StyleContainer,
} = window?.divi?.module;

/**
 * React function component for rendering module style.
 */
const ModuleStyles = (params) => {
    const {
        attrs,
        elements,
        settings,
        orderClass,
        mode,
        state,
        noStyleTag
    } = params;
    return (
        <StyleContainer mode={mode} state={state} noStyleTag={noStyleTag}>
            {/* Element: Module */}

            {elements.style({
                attrName: 'module',
                styleProps: {
                    disabledOn: {
                        disabledModuleVisibility: settings?.disabledModuleVisibility
                    }
                }
            })}
            {elements.style({
                attrName: 'bar',
                styleProps: {
                    advancedStyles: [
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .divi-tutor-progress-bar,${orderClass} .divi-tutor-progress-line`,
                                attr: attrs?.bar?.advanced?.thickness,
                                property: 'height'
                            }
                        }
                    ]
                }
            })}
            {elements.style({
                attrName: 'line'
            })}



        </StyleContainer>
    )
};
export default ModuleStyles;