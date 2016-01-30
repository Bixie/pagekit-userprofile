module.exports = {

    el: '#userprofile-registration',

    data: function () {
        return _.merge({
            error: '',
            fields: [],
            profilevalues: {},
            user: {},
            form: {}
        }, window.$data);
    },

    created: function () {
        //prepare values
        this.fields.forEach(function (field) {
            this.profilevalues[field.slug] = {
                field_id: field.id,
                slug: field.slug,
                type: field.type,
                label: field.label,
                value: null,
                field: field,
                data: {value: null, id: 0}
            };
        }.bind(this));
    },

    methods: {

        save: function () {

            this.$set('error', '');

            this.$http.post('user/registration/register', {
                user: this.user,
                profilevalues: this.profilevalues
            }).then(function (res) {
                window.location.replace(res.data.redirect);
            }, function (res) {
                this.error = res.data;
            });
        }

    }

};

Vue.ready(module.exports);
