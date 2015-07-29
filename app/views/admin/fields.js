
module.exports = {

    data: function () {
        return _.merge({
            users: false,
            pages: 0,
            count: '',
            types: [],
            selected: []
        }, window.$data);
    },

    created: function () {
        this.Fields = this.$resource('api/userprofile/field/:id');
        this.load();
    },


    methods: {

        load: function () {
            return this.Fields.query(function (data) {
                this.$set('fields', data);
            });
        },

        toggleRequired: function (field) {

            field.data.required = field.data.required ? 0 : 1;

            this.Fields.save({id: field.id}, {field: field}, function () {
                this.load();
                UIkit.notify('Field saved.');
            });
        },

        getSelected: function () {
            return this.fields.filter(function (field) {
                return this.isSelected(field);
            }, this);
        },

        isSelected: function (field, children) {

            if (_.isArray(field)) {
                return _.every(field, function (field) {
                    return this.isSelected(field, children);
                }, this);
            }

            return this.selected.indexOf(field.id.toString()) !== -1 && (!children || !this.tree[field.id] || this.isSelected(this.tree[field.id], true));
        },

        toggleSelect: function(field) {

            var index = this.selected.indexOf(field.id.toString());

            if (index == -1) {
                this.selected.push(field.id.toString());
            } else {
                this.selected.splice(index, 1);
            }
        },

        getType: function (field) {
            return _.find(this.types, 'id', field.type);
        },

        removeFields: function () {

            this.Fields.delete({id: 'bulk'}, {ids: this.selected}, function () {
                this.load();
                UIkit.notify('Fields(s) deleted.');
            });
        }



    },

    components: {

        field: {

            inherit: true,
            template: '#field',

            computed: {
                type: function() {
                    return this.getType(this.field);
                }

            }
        }

    },

    watch: {

        fields: function () {

            var vm = this;

            // TODO this is still buggy
            UIkit.nestable(this.$$.nestable, {
                maxDepth: 1,
                group: 'userprofile.fields'
            }).off('change.uk.nestable').on('change.uk.nestable', function (e, nestable, el, type) {

                if (type && type !== 'removed') {

                    vm.Fields.save({id: 'updateOrder'}, {fields: nestable.list()}, function () {

                        // @TODO reload everything on reorder really needed?
                        vm.load().success(function () {

                            // hack for weird flickr bug
                            if (el.parent()[0] === nestable.element[0]) {
                                setTimeout(function () {
                                    el.remove();
                                }, 50);
                            }
                        });

                    }).error(function () {
                        UIkit.notify(this.$trans('Reorder failed.'), 'danger');
                    });
                }
            });
        }
    }

};


$(function () {

    new Vue(module.exports).$mount('#userprofile-fields');

});

