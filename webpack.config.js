module.exports = [

    {
        entry: {
            "settings": "./app/components/settings.vue",
            "site": "./app/components/site.vue",
            "link": "./app/components/link.vue",
            "userprofile": "./app/views/profile.js",
            "registration": "./app/views/registration.js",
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
