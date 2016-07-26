module.exports = {

    el: '#userprofile-settings',

    data: function () {
        return window.$data;
    },

    fields: require('../../settings/fields'),


    methods: {

        save: function () {
            this.$http.post('admin/userprofile/config', { config: this.config }).then(function () {
                this.$notify('Settings saved.');
            }, function (res) {
                this.$notify(res.data, 'danger');
            });
        }

    }

};

Vue.ready(module.exports);
