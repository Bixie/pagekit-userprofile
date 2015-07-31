module.exports = Vue.extend({

    data: function () {
        var defaults = {
            field: {
                data: {
                    classSfx: '',
                    required: false
                }
            }
        };
        _.forEach(this.getFieldOptions(window.$data.type.id).dataFields, function (defaultValue, name) {
            defaults.field.data[name] = defaultValue;
        });
        return _.merge(defaults, window.$data);
    },

    ready: function () {
        this.Fields = this.$resource('api/userprofile/field/:id');
        this.tab = UIkit.tab(this.$$.tab, {connect: this.$$.content});
    },

    computed: {

        hasOptions: function () {
            return this.getFieldOptions().hasOptions;
        }

    },

    methods: {

        fieldOption: function (name) {
            return this.getFieldOptions().dataFields[name] !== undefined;
        },

        save: function (e) {

            e.preventDefault();

            var data = {field: this.field};

            this.$broadcast('save', data);

            this.Fields.save({id: this.field.id}, data, function (data) {

                if (!this.field.id) {
                    window.history.replaceState({}, '', this.$url('admin/userprofile/edit', {id: data.field.id}))
                }

                this.$set('field', data.field);

                UIkit.notify(this.$trans('%type% saved.', {type: this.type.label}));

            }, function (data) {
                UIkit.notify(data, 'danger');
            });
        },

        getFieldOptions: function (type) {
            var profileFieldoptions = window.Profilefields.getFieldoptions();
            type = type || this.$get('type.id');
            return profileFieldoptions[type];
        }

    },

    components: {

        fieldbasic: require('../../components/field-basic.vue'),
        fieldoptions: require('../../components/field-options.vue'),
        appearance: require('../../components/appearance.vue')

    }

});

$(function () {

    (new module.exports()).$mount('#field-edit');

});
