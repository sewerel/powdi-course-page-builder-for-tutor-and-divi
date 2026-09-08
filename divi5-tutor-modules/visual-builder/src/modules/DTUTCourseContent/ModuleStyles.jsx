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
                    },
                    advancedStyles: [

                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-accordion-item:nth-last-child(n+2)`,
                                attr: attrs?.module?.advanced?.gap,
                                property: 'margin-bottom'
                            }
                        }
                    ]
                }
            })}
            {elements.style({
                attrName: 'topics',
                styleProps: {
                    advancedStyles: [
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-accordion-item-header::after`,
                                selectors: {
                                    desktop: {
                                        value: `${orderClass} .tutor-accordion-item-header::after`,
                                        hover: `${orderClass} .tutor-accordion-item-header{{:hover}}::after`,
                                    }
                                },
                                attr: attrs?.topics?.advanced?.iconColor,
                                property: 'color'
                            }
                        },
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-accordion-item-header::after`,
                                attr: attrs?.topics?.advanced?.iconSize,
                                property: 'font-size'
                            }
                        },
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-accordion .tutor-accordion-item-header.is-active`,
                                attr: attrs?.topics?.advanced?.activeBackground,
                                property: 'background-color'
                            }
                        },
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-accordion .tutor-accordion-item-header.is-active`,
                                attr: attrs?.topics?.advanced?.activeColor,
                                property: 'color'
                            }
                        },
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-accordion-item-header.is-active::after`,
                                selectors: {
                                    desktop: {
                                        value: `${orderClass} .tutor-accordion-item-header.is-active::after`,
                                        hover: `${orderClass} .tutor-accordion-item-header.is-active{{:hover}}::after`,
                                    }
                                },
                                attr: attrs?.topics?.advanced?.activeIconColor,
                                property: 'color'
                            }
                        },
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-accordion-item-header.is-active::after`,
                                attr: attrs?.topics?.advanced?.activeIconSize,
                                property: 'font-size'
                            }
                        }

                    ]
                }
            })}
            {elements.style({
                attrName: 'lessons',
                styleProps: {
                    advancedStyles: [
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-course-content-list-item-duration`,
                                attr: attrs?.lessons?.advanced?.infoColor,
                                property: 'color'
                            }
                        },
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-course-content-list-item-icon,${orderClass} .tutor-course-content-list-item-status`,
                                selectors: {
                                    desktop: {
                                        value: `${orderClass} .tutor-course-content-list-item-icon,${orderClass} .tutor-course-content-list-item-status`,
                                        hover: `${orderClass} .tutor-course-content-list-item{{:hover}} .tutor-course-content-list-item-icon,${orderClass} .tutor-course-content-list-item{{:hover}} .tutor-course-content-list-item-status`,
                                    }
                                },
                                attr: attrs?.lessons?.advanced?.iconColor,
                                property: 'color'
                            }
                        },
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-course-content-list-item-icon,${orderClass} .tutor-course-content-list-item-status`,
                                attr: attrs?.lessons?.advanced?.iconSize,
                                property: 'font-size'
                            }
                        }

                    ]
                }
            })}
            {elements.style({
                attrName: 'topicsContent',
                styleProps: {
                    advancedStyles: [
                        {
                            componentName: "divi/common",
                            props: {
                                selector: `${orderClass} .tutor-accordion-item .tutor-accordion-item-body-content`,
                                attr: attrs?.topicsContent?.advanced?.noDivider,
                                declarationFunction: ({ attrValue }) => {
                                    if ('on' === attrValue) {
                                        return 'border-top:none!important;'
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