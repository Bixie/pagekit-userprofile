module.exports = {

    data: window.$data,

    methods: {

        save: function (e) {
            e.preventDefault();

            this.$set('message', '');
            this.$set('error', '');

            this.$http.post('user/profile/save', {user: this.user, profilevalues: this.profilevalues}, function () {
                this.message = this.$trans('Profile Updated');
            }).error(function (error) {
                this.error = error;
            });
        }

    },

    components: {

        text: require('../fields/text.vue'),
        pulldown: require('../fields/pulldown.vue')

    },

    computed: {
    }


};

$(function () {

    new Vue(module.exports).$mount('#userprofile-profile');

});
