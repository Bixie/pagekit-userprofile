module.exports = {

    el: '#userprofile-profile',

    data: function () {
        return _.merge({
            message: '',
            error: '',
            form: {}
        }, window.$data);
    },

    methods: {

        save: function () {

            this.$set('message', '');
            this.$set('error', '');

            this.$http.post('user/profile/save', {user: this.user, profilevalues: this.profilevalues}).then(function () {
                //todo return new profilevalues ids
                this.message = this.$trans('Profile Updated');
            }, function (error) {
                this.error = error;
            });
        }

    }

};

Vue.ready(module.exports);
