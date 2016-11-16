var glob = require("glob");
var path = require("path");
var fieldtypes = {};

glob.sync(path.join(__dirname, 'fieldtypes/*/*.vue')).forEach(function (file) {
    var type = path.basename(file, '.vue');
    fieldtypes['userprofile-' + type] = './fieldtypes/' + type + '/' + type + '.vue';
});



module.exports = [

    {
        entry: fieldtypes,
        output: {
            filename: "./app/bundle/[name].js"
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
            "link-userprofile": "./app/components/link-userprofile.vue",
            "user-section-userprofile": "./app/components/user-section-userprofile.vue",
            "node-user_profiles": "./app/components/node-user_profiles.vue",
            /*frontpage views*/
            "userprofiles": "./app/views/profiles.js",
            "userprofiles-details": "./app/views/profiles-details.js",
            "userprofile": "./app/views/profile.js",
            "registration": "./app/views/registration.js",
            /*admin views*/
            "field-edit": "./app/views/admin/edit.js",
            "fields": "./app/views/admin/fields.js",
            "userprofile-settings": "./app/views/admin/settings.js"
        },
        output: {
            filename: "./app/bundle/[name].js"
        },
        externals: {
            "lodash": "_",
            "jquery": "jQuery",
            "uikit": "UIkit",
            "vue": "Vue"
        },
        module: {
            loaders: [
                {test: /\.vue$/, loader: "vue"},
                { test: /\.html$/, loader: "vue-html" },
                {test: /\.js/, loader: 'babel', query: {presets: ['es2015']}}
            ]
        }
    }

];
