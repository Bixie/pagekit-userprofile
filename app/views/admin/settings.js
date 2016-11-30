module.exports = {

    el: '#userprofile-settings',

    data() {
        return window.$data;
    },

    fields: require('../../settings/fields'),


    methods: {

        save() {
            this.$http.post('admin/userprofile/config', { config: this.config }).then(function () {
                this.$notify('Settings saved.');
            }, function (res) {
                this.$notify(res.data, 'danger');
            });
        }

    },

    computed: {
        fieldOptions() {
            return this.fields.map(field => {
                return {value: field.slug, text: field.label};
            });
        },
        uploadFields() {
            return this.fields.filter(field => {
                return field.type === 'upload';
            });
        }
    }

};

Vue.ready(module.exports);
