module.exports = {

    el: '#field-edit',

    data: function () {
        return _.merge({
            field: {
                data: {
                    classSfx: '',
                    required: false
                }
            },
            form: {}
        }, window.$data);
    },

    created: function () {
        if (this.type.required !== -1) this.field.data.required = this.type.required;
        if (this.type.multiple !== -1) this.field.data.multiple = this.type.multiple;
    },

    ready: function () {
        this.Fields = this.$resource('api/userprofile/field/:id');
        this.tab = UIkit.tab(this.$els.tab, {connect: this.$els.content});
    },

    methods: {

        save: function () {

            var data = {field: this.field};

            this.$broadcast('save', data);

            this.Fields.save({id: this.field.id}, data, function (data) {

                if (!this.field.id) {
                    window.history.replaceState({}, '', this.$url.route('admin/userprofile/edit', {id: data.field.id}))
                }

                this.$set('field', data.field);

                this.$notify(this.$trans('%type% saved.', {type: this.type.label}));

            }, function (data) {
                this.$notify(data, 'danger');
            });
        }

    },

    computed: {
        fieldSettings: function () {
            var settings = this.field.type ? Profilefields.components[this.field.type].settings : {},
                parent = this;
            if (settings.template !== undefined) {
                new Vue(_.merge({
                    'el': '#type-settings',
                    'name': 'type-settings',
                    'parent': parent,
                    'data':  _.merge({
                        'field': parent.field,
                        'form': parent.form
                    }, settings.data),
                }, settings));
                return false;
            }
            return settings;
        }
    },

    components: {

        fieldbasic: require('../../components/field-basic.vue'),
        fieldoptions: require('../../components/field-options.vue'),
        appearance: require('../../components/appearance.vue')

    }

};

Vue.field.templates.formrow = require('../../templates/formrow.html');
Vue.field.templates.raw = require('../../templates/raw.html');
Vue.field.types.text = '<input type="text" v-bind="attrs" v-model="value">';
Vue.field.types.textarea = '<textarea v-bind="attrs" v-model="value"></textarea>';
Vue.field.types.select = '<select v-bind="attrs" v-model="value"><option v-for="option in options" :value="option">{{ $key }}</option></select>';
Vue.field.types.radio = '<p class="uk-form-controls-condensed"><label v-for="option in options"><input type="radio" :value="option" v-model="value"> {{ $key | trans }}</label></p>';
Vue.field.types.checkbox = '<p class="uk-form-controls-condensed"><label><input type="checkbox" v-bind="attrs" v-model="value" v-bind:true-value="1" v-bind:false-value="0" number> {{ optionlabel | trans }}</label></p>';
Vue.field.types.number = '<input type="number" v-bind="attrs" v-model="value" number>';
Vue.field.types.title = '<h3 v-bind="attrs">{{ title | trans }}</h3>';
Vue.field.types.editor = '<v-editor :value.sync="value" :options="{markdown : field.markdown}" v-bind="attrs"></v-editor>';

Vue.ready(module.exports);
