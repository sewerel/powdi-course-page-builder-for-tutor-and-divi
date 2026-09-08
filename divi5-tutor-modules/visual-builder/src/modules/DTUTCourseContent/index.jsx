// External library dependencies.
//import SettingsDesign from './settingsDesign.jsx';
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

/**
 * Callbacks functions
 */
const is_default_tab = ({ attrs }) => 'default' === (attrs?.topics?.advanced?.tabs?.desktop?.value ?? 'default')
const is_active_tab = ({ attrs }) => 'active' === attrs?.topics?.advanced?.tabs?.desktop?.value

/**
 * DTUTCourseContent.
 */
const DTUTCourseContent = {
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
        //design: SettingsDesign
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
    callbacks: {
        design: {
            designTopics: {
                fields: {
                    topicsAdvancedIconcolor: {
                        visible: is_default_tab
                    },
                    topicsAdvancedIconsize: {
                        visible: is_default_tab
                    },
                    topicsAdvancedActivebackground: {
                        visible: is_active_tab
                    },
                    topicsAdvancedActivecolor: {
                        visible: is_active_tab
                    },
                    topicsAdvancedActiveiconcolor: {
                        visible: is_active_tab
                    },
                    topicsAdvancedActiveiconsize: {
                        visible: is_active_tab
                    },
                    topicsDecorationBackground: {
                        visible: is_default_tab
                    },
                    topicsDecorationBorder: {
                        visible: is_default_tab
                    },
                    topicsDecorationFont: {
                        visible: is_default_tab
                    },
                    topicsDecorationSpacing: {
                        visible: is_default_tab
                    },

                }
            }

        },
    }
};


addFilter('divi.iconLibrary.icon.map', 'divitutortheme', (icons) => {
    return {
        ...icons, // This is important. Without this, all other icons will be overwritten.
        [icon.name]: icon,
    };
});
// Register module.
addAction('divi.moduleLibrary.registerModuleLibraryStore.after', 'powdithemestrendy', () => {
    registerModule(DTUTCourseContent.metadata, DTUTCourseContent);
});