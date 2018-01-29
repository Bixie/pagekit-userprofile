/*globals _, Vue, UIkit */

const UserprofileFields = {

    el: '#userprofile-fields',

    name: 'UserprofileFields',

    components: {

        field: {
            name: 'ProfileField',
            props: {'field': Object,},
            computed: {
                type() {
                    return this.$root.getType(this.field);
                },
            },
            methods: {
                isSelected(field) {
                    return this.$root.isSelected(field);
                },
            },
            template: '#field',
        },

    },

    data: () => _.merge({
        users: false,
        pages: 0,
        count: '',
        fields: [],
        types: [],
        selected: [],
    }, window.$data),

    watch: {

        fields() {

            const vm = this;

            // TODO this is still buggy
            UIkit.nestable(this.$els.nestable, {
                maxDepth: 1,
                group: 'userprofile.fields',
            }).off('change.uk.nestable').on('change.uk.nestable', (e, nestable, el, type) => {

                if (type && type !== 'removed') {

                    vm.Fields.save({id: 'updateOrder',}, {fields: nestable.list(),}).then(() => {

                        // @TODO reload everything on reorder really needed?
                        vm.load().success(function () {

                            // hack for weird flickr bug
                            if (el.parent()[0] === nestable.element[0]) {
                                setTimeout(function () {
                                    el.remove();
                                }, 50);
                            }
                        });

                    },() => this.$notify('Reorder failed.', 'danger'));
                }
            });
        },
    },

    created() {
        this.Fields = this.$resource('api/userprofile/field{/id}');
        this.load();
    },

    methods: {

        load() {
            return this.Fields.query().then(res => {
                this.$set('fields', res.data);
            });
        },

        toggleRequired(field) {

            field.data.required = field.data.required ? 0 : 1;

            this.Fields.save({id: field.id,}, {field,}).then(function () {
                this.load();
                this.$notify('Field saved.');
            }, function (res) {
                this.load();
                this.$notify(res.data, 'danger');
            });
        },

        getSelected() {
            return this.fields.filter(function (field) {
                return this.isSelected(field);
            }, this);
        },

        isSelected(field, children) {

            if (_.isArray(field)) {
                return _.every(field, function (field) {
                    return this.isSelected(field, children);
                }, this);
            }

            return this.selected.indexOf(field.id.toString()) !== -1 && (!children || !this.tree[field.id] || this.isSelected(this.tree[field.id], true));
        },

        toggleSelect(field) {

            const index = this.selected.indexOf(field.id.toString());

            if (index === -1) {
                this.selected.push(field.id.toString());
            } else {
                this.selected.splice(index, 1);
            }
        },

        getType(field) {
            return _.find(this.types, 'id', field.type);
        },

        removeFields() {

            this.Fields.delete({id: 'bulk',}, {ids: this.selected,}).then(function () {
                this.load();
                this.$notify('Fields(s) deleted.');
            });
        },

    },

};


Vue.ready(UserprofileFields);
export default UserprofileFields;
