/*globals _, Vue */
import fields from '../../settings/fields';

const UserprofileSettings = {

    el: '#userprofile-settings',

    name: 'UserprofileSettings',

    data: () => _.merge({}, window.$data),

    fields,

    methods: {

        save() {
            if (!this.uploadFields.length) {
                //clear value when field is removed
                this.config.avatar_field = '';
            }
            this.$http.post('admin/userprofile/config', { config: this.config,})
                .then(() => this.$notify('Settings saved.'), res => this.$notify(res.data, 'danger'));
        },

    },

    computed: {
        fieldOptions() {
            return this.fields.map(field => {
                return {value: field.slug, text: field.label,};
            });
        },
        uploadFields() {
            return this.fields.filter(field => field.type === 'upload');
        },
    },

};

Vue.ready(UserprofileSettings);
export default UserprofileSettings;
