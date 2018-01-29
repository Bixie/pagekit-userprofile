/*globals _, Vue, UIkit */
import FieldBasic from '../../components/field-basic.vue';
import FieldOptions from '../../components/field-options.vue';
import FieldAppearance from '../../components/appearance.vue';

const FieldEdit = {

    el: '#field-edit',

    name: 'FieldEdit',

    components: {
        'field-basic': FieldBasic,
        'field-options': FieldOptions,
        'field-appearance': FieldAppearance,
    },

    data: () => _.merge({
        field: {
            label: '',
            type: '',
            data: {
                value: [],
                data: {},
                classSfx: '',
                help_text: '',
                help_show: '',
            },
        },
        form: {},
    }, window.$data, window.$userprofile),

    created() {
        if (this.type.required !== -1) {
            this.field.data.required = this.type.required;
        }
        if (this.type.multiple !== -1) {
            this.field.data.multiple = this.type.multiple;
        }
    },

    ready() {
        this.Fields = this.$resource('api/userprofile/field/{id}');
        this.tab = UIkit.tab(this.$els.tab, {connect: this.$els.content,});
    },

    methods: {

        save() {

            const data = {field: this.field,};
            this.$broadcast('save', data);

            this.Fields.save({id: (this.field.id || 0),}, data).then(res => {

                if (!this.field.id) {
                    window.history.replaceState({}, '', this.$url.route('admin/userprofile/edit', {id: res.data.field.id,}))
                }

                this.$set('field', res.data.field);

                this.$notify(this.$trans('%type% saved.', {type: this.type.label,}));

            }, res => this.$notify(res.data, 'danger'));

        },

    },

};

Vue.ready(FieldEdit);
export default FieldEdit;