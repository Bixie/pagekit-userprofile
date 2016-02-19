module.exports = {

    el: '#userprofile-registration',

    data: function () {
        return _.merge({
            error: '',
            fields: [],
            profilevalues: {},
            user: {},
            form: {}
        }, window.$data, window.$userprofile);
    },

    created: function () {
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
