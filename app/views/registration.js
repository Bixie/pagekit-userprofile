/*globals Vue, _ */
// @vue/component
const UserprofileRegistration = {

    el: '#userprofile-registration',

    name: 'UserprofileRegistration',

    data: () => _.merge({
        error: '',
        fields: [],
        profilevalues: {},
        user: {},
        form: {},
    }, window.$data, window.$userprofile),

    methods: {

        save() {
            this.$set('error', '');
            this.$http.post('user/registration/register', {
                user: this.user,
                profilevalues: this.profilevalues,
            }).then(res => {
                window.location.replace(res.data.redirect);
            }, res => {
                this.error = res.data;
            });
        },

    },

};

Vue.ready(UserprofileRegistration);
