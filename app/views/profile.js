/*globals _, Vue */
const UserprofileProfile = {

    el: '#userprofile-profile',

    name: 'UserprofileProfile',

    data: () => _.merge({
        message: '',
        error: '',
        form: {},
    }, window.$data, window.$userprofile),

    methods: {

        save() {

            this.$set('message', '');
            this.$set('error', '');

            this.$http.post('user/profile/save', {user: this.user, profilevalues: this.profilevalues}).then(() => {
                //todo return new profilevalues ids
                this.message = this.$trans('Profile Updated');
            }, res => this.error = res.data);
        },

    },

};

Vue.ready(UserprofileProfile);
export default UserprofileProfile;