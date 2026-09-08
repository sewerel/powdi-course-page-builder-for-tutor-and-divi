// External library dependencies.
// import SettingsDesign from './settingsDesign.jsx';
//import SettingsContent from './settingsContent.jsx';
//const { placeholderContent } = window?.divi?.moduleUtils;
// Module metadata that is used in both Frontend and Visual Builder.
import metadata from './module.json';
import defaultAttrs from './defaultAttrs.json';
//import './style.css';
import icon from './icon.jsx';
import Render from './render.jsx';


// WordPress package dependencies.
const {
    addAction,
    addFilter
} = window?.vendor?.wp?.hooks;
const { __ } = window?.vendor?.wp?.i18n;
// Divi package dependencies.

const {
    registerModule
} = window?.divi?.moduleLibrary




const is_head_tab = ({ attrs }) => 'head' === (attrs?.table?.advanced?.tabs?.desktop?.value ?? 'head')
const is_data_tab = ({ attrs }) => 'data' === attrs?.table?.advanced?.tabs?.desktop?.value

const is_p_tab = ({ attrs }) => 'p' === (attrs?.endpointContent?.advanced?.tabs?.desktop?.value ?? 'p')
const is_link_tab = ({ attrs }) => 'link' === attrs?.endpointContent?.advanced?.tabs?.desktop?.value
const is_h2_tab = ({ attrs }) => 'h2' === attrs?.endpointContent?.advanced?.tabs?.desktop?.value
const is_h3_tab = ({ attrs }) => 'h3' === attrs?.endpointContent?.advanced?.tabs?.desktop?.value

const is_fields_tab = ({ attrs }) => 'fields' === (attrs?.forms?.advanced?.tabs?.desktop?.value ?? 'fields')
const is_focus_tab = ({ attrs }) => 'focus' === attrs?.forms?.advanced?.tabs?.desktop?.value
const is_labels_tab = ({ attrs }) => 'labels' === attrs?.forms?.advanced?.tabs?.desktop?.value

/**
 * React function component for registering module script data.
 */


/**
 * DTUTCourseButtons.
 */
const DTUTCourseButtons = {
    // Metadata that is used on Visual Builder and Frontend
    metadata,
    defaultAttrs,
    //defaultPrintedStyleAttrs,

    // Layout renderer components.
    renderers: {
        // React Function Component for rendering module's output on layout area.
        edit: Render,
    },
    settings: {
        //content: SettingsContent,
        // design: SettingsDesign
        //advanced: SettingsAdvanced 
    },

    // Attribute that is automatically added into the module when the module is inserted
    // into the layout so that the newly inserted module has some placeholder content
    // placeholderContent: {
    //         module: {
    //             meta: {
    //                 adminLabel: {
    //                     desktop: {
    //                         value: "Text (top left)"
    //                     }
    //                 }
    //             }
    //         },
    //         content: {
    //             innerContent: {
    //                 desktop: {
    //                     value: "Sale"
    //                 }
    //             }
    //         },
    //         image: {
    //             innerContent: {
    //                 desktop: {
    //                     value: starImage
    //                 }
    //             }
    //         }
    // },
    // callbacks: {
    //     design: {
    //         designTables: {
    //             fields: {
    //                 dataAdvancedBackgroundeven: {
    //                     visible: is_data_tab
    //                 },
    //                 dataAdvancedBackgroundodd: {
    //                     visible: is_data_tab
    //                 },
    //                 dataDecorationSpacing: {
    //                     visible: is_data_tab
    //                 },
    //                 dataDecorationFont: {
    //                     visible: is_data_tab
    //                 },
    //                 headAdvancedBackground: {
    //                     visible: is_head_tab
    //                 },
    //                 headDecorationSpacing: {
    //                     visible: is_head_tab
    //                 },
    //                 headDecorationFont: {
    //                     visible: is_head_tab
    //                 }

    //             }
    //         },
    //         designEndpointContent: {
    //             fields: {
    //                 endpointPDecorationFont: {
    //                     visible: is_p_tab
    //                 },
    //                 endpointLinkDecorationFont: {
    //                     visible: is_link_tab
    //                 },
    //                 endpointH2DecorationFont: {
    //                     visible: is_h2_tab
    //                 },
    //                 endpointH3DecorationFont: {
    //                     visible: is_h3_tab
    //                 }
    //             }
    //         },
    //         designForms: {
    //             fields: {
    //                 fieldsDecorationBackground: {
    //                     visible: is_fields_tab
    //                 },
    //                 fieldsDecorationFont: {
    //                     visible: is_fields_tab
    //                 },
    //                 fieldsDecorationSpacing: {
    //                     visible: is_fields_tab
    //                 },
    //                 fieldsDecorationBorder: {
    //                     visible: is_fields_tab
    //                 },
    //                 fieldsFocusDecorationBackground: {
    //                     visible: is_focus_tab
    //                 },
    //                 fieldsFocusDecorationFont: {
    //                     visible: is_focus_tab
    //                 },
    //                 fieldsFocusDecorationBorder: {
    //                     visible: is_focus_tab
    //                 },
    //                 labelsDecorationFont: {
    //                     visible: is_labels_tab
    //                 },
    //             }
    //         }

    //     },
    // }
};


addFilter('divi.iconLibrary.icon.map', 'divitutortheme', (icons) => {
    return {
        ...icons, // This is important. Without this, all other icons will be overwritten.
        [icon.name]: icon,
    };
});
// Register module.
addAction('divi.moduleLibrary.registerModuleLibraryStore.after', 'powdithemestrendy', () => {
    registerModule(DTUTCourseButtons.metadata, DTUTCourseButtons);
});