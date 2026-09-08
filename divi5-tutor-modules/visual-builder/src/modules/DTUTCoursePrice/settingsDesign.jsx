const { ModuleGroups } = window?.divi?.module;

const SettingsDesign = (params) => {
    const { attrs, groupConfiguration } = params;
    //console.log(groupConfiguration)

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

export default SettingsDesign;


// const {
//     fetch,
// } = useFetch();

// useEffect(() => {
//     if (Array.isArray(postCategories)) {
//         const allCategories: typeof defaultCategories = [];
//         postCategories.forEach(item => {
//             allCategories.push({ label: item.name, value: item.term_id.toString() });
//         });

//         setCategories(state => [...state, ...allCategories]);
//     }

//     fetch({
//         method: 'GET',
//         restRoute: '/divi/v1/module-data/blog/types',
//     }).then((value: FieldLibrary.Select.Options) => {
//         setPostTypes(value);
//     }).catch(error => {
//         // TODO feat(D5, Logger) - We need to introduce a new logging system to log errors/rejections/etc.
//         // eslint-disable-next-line no-console
//         console.log(error);
//     });
// }, []);

// // Insert props value to `content` group.
// if (groupConfiguration?.content?.component) {
//     set(groupConfiguration, ['content', 'component', 'props', 'fields', 'postAdvancedUsecurrentloop', 'visible'], isVisibleFields);
//     set(groupConfiguration, ['content', 'component', 'props', 'fields', 'postAdvancedExcerptmanual', 'visible'], isVisibleFields);
//     set(groupConfiguration, ['content', 'component', 'props', 'fields', 'postAdvancedExcerptlength', 'visible'], isVisibleFields);

//     set(groupConfiguration, ['content', 'component', 'props', 'fields', 'postAdvancedType', 'visible'], isVisibleFields);
//     set(groupConfiguration, ['content', 'component', 'props', 'fields', 'postAdvancedType', 'component', 'props', 'options'], postTypes);

//     set(groupConfiguration, ['content', 'component', 'props', 'fields', 'postAdvancedCategories', 'visible'], isVisibleFields);
//     set(groupConfiguration, ['content', 'component', 'props', 'fields', 'postAdvancedCategories', 'component', 'props', 'options'], categories);
// }