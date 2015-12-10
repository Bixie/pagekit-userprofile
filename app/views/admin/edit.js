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

    components: {

        fieldbasic: require('../../components/field-basic.vue'),
        fieldoptions: require('../../components/field-options.vue'),
        appearance: require('../../components/appearance.vue')

    }

};

Vue.ready(module.exports);
