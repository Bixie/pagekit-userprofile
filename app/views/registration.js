module.exports = {

    data: window.$data,

    methods: {

        save: function (e) {
            e.preventDefault();

            this.$set('error', '');

            this.$http.post('user/registration/register', {user: this.user, profilevalues: this.profilevalues}, function (data) {
                console.log(data.redirect);
                //window.location.replace(data.redirect);
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

    new Vue(module.exports).$mount('#userprofile-registration');

});
