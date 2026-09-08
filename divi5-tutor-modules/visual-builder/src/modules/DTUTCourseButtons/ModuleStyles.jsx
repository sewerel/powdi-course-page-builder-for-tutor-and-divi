const {
    StyleContainer,
    BackgroundStyle,
    ButtonStyle,
    FontStyle,
    SpacingStyle,
    IconStyle
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
                attrName: 'buttons',
                styleProps: {
                    advancedStyles: [
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass}`,
                                attr: attrs?.buttons?.decoration?.button,
                                declarationFunction: ({ attrValue }) => {
                                    if (attrValue?.alignment) {
                                        return `text-align:${attrValue.alignment};`
                                    }
                                }
                            }
                        }
                    ]
                }
            })}

        </StyleContainer>
    )
};
export default ModuleStyles;