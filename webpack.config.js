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
            "site": "./app/components/site.vue",
            "link": "./app/components/link.vue",
            /*fields*/
            "userprofile-text": "./app/fields/text.vue",
            "userprofile-pulldown": "./app/fields/pulldown.vue",
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
