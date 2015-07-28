module.exports = [

    {
        entry: {
            "settings": "./app/components/settings.vue",
            "site": "./app/components/site.vue",
            "link": "./app/components/link.vue",
            "field-edit": "./app/views/edit.js",
            "fields": "./app/views/fields.js"
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
                { test: /\.vue$/, loader: "vue" }
            ]
        }
    }

];
