const { ModuleGroups } = window?.divi?.module;
const SettingsContent = (params) => {
    const { attrs, groupConfiguration } = params;
    const endpoints = ClassicMyaccountModuleVisualBuilderData?.endpoints ?? {};
    endpoints.divi_map_login = {
        label: 'Login Form'
    }
    endpoints.divi_map_lost_password = {
        label: 'Lost Password'
    }
    groupConfiguration.contentPreview.component.props.fields.moduleAdvancedEndpoint.component.props.options = endpoints;
    // const useFade = attrs?.content?.advanced?.useFade?.desktop?.value;
    // if (useFade && useFade === 'on') {
    //     groupConfiguration.designMovingOptions.component.props.fields.contentAdvancedFadecolor.visible = true;
    //     groupConfiguration.designMovingOptions.component.props.fields.contentAdvancedFadewidth.visible = true;
    // }
    // // Show Image Size option only if image is added
    // if (attrs?.image?.innerContent) {
    // }
    // // Show Rotation Duration only if rotation is not 'none'
    // if (attrs?.content?.advanced?.rotation?.desktop?.value !== 'none') {
    //     groupConfiguration.designRotation.component.props.fields.contentAdvancedDuration.component.props.visible = true;
    // }
    return (<ModuleGroups
        groups={groupConfiguration}
    />);
};
export default SettingsContent;