module.exports = [

    {
        entry: {
            "userprofile-profilefields": "./app/components/profilefields.vue"
        },
        output: {
            filename: "./app/bundle/[name].js",
            library: "Profilefields"
        },
        module: {
            loaders: [
                { test: /\.vue$/, loader: "vue" }
            ]
        }
    },

    {
        entry: {
            /*pagekit addons*/
            "settings": "./app/components/settings.vue",
            "node-userprofile": "./app/components/node-userprofile.vue",
            "link-userprofile": "./app/components/link-userprofile.vue",
            "user-section-userprofile": "./app/components/user-section-userprofile.vue",
            /*fields*/
            "userprofile-checkbox": "./app/fields/checkbox.vue",
            "userprofile-dob": "./app/fields/dob.vue",
            "userprofile-pulldown": "./app/fields/pulldown.vue",
            "userprofile-radio": "./app/fields/radio.vue",
            "userprofile-text": "./app/fields/text.vue",
            /*frontpage views*/
            "userprofile": "./app/views/profile.js",
            "registration": "./app/views/registration.js",
            /*admin views*/
            "field-edit": "./app/views/admin/edit.js",
            "fields": "./app/views/admin/fields.js"
        },
        output: {
            filename: "./app/bundle/[name].js",
            library: "Fields"
        },
        externals: {
            "lodash": "_",
            "jquery": "jQuery",
            "uikit": "UIkit",
            "vue": "Vue"
        },
        module: {
            loaders: [
                {test: /\.vue$/, loader: "vue"}
            ]
        }
    }

];
