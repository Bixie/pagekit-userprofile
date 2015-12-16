module.exports = {

    el: '#userprofile-registration',

    data: window.$data,

    methods: {

        save: function () {

            this.$set('error', '');

            this.$http.post('user/registration/register', {
                user: this.user,
                profilevalues: this.profilevalues
            }, function (data) {
                window.location.replace(data.redirect);
            }).error(function (error) {
                this.error = error;
            });
        }

    }

};

Vue.ready(module.exports);
