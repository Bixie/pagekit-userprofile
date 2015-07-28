<template>

    <div class="uk-form-horizontal">

        <div class="uk-form-row">
            <span class="uk-form-label">{{ 'Options' | trans }}</span>
            <div class="uk-form-controls uk-form-controls-text">
                <ul class="uk-nestable uk-margin-remove" v-el="optionsNestable" v-show="field.options.length">
                    <template v-repeat="option: field.options">
                        <selectoption selectoption="{{@ option }}"></selectoption>
                    </template>
                </ul>
                <button type="button" class="uk-button uk-button-primary uk-button-small uk-margin" v-on="click: addOption">{{ 'Add option' | trans}}</button>
            </div>
        </div>

    </div>
</template>

<script>

    module.exports = {

        props: ['field'],

        methods: {
            addOption: function () {
                this.field.options.push({
                    value: '',
                    text: 'sdfgsdgd'
                });
            }
        },

        ready: function () {
            var vm = this;
            UIkit.nestable(this.$$.optionsNestable, {
                maxDepth: 1,
                handleClass: 'uk-nestable-handle',
                group: 'userprofile.selectoptions'
            }).on('change.uk.nestable', function (e, nestable, el, type) {
                if (type && type !== 'removed') {

                    var options = [];
                    _.forEach(nestable.list(), function (option) {
                        options.push(_.find(vm.field.options, 'value', option.value));
                    });

                    vm.$set('field.options', options);

                }
            });

        },

        components: {

            selectoption: {

                template: '<li class="uk-nestable-item uk-flex uk-flex-middle" data-value="{{ selectoption.value }}">\n    <div class="uk-flex-item-1">\n        <input type="text" class="uk-form-width-large uk-form-blank" v-model="selectoption.value"/><br/>\n        <input type="text" class="uk-form-width-large" v-model="selectoption.text"/>\n    </div>\n    <div>\n        <a class="uk-icon uk-icon-arrows-alt uk-icon-hover uk-nestable-handle"></a>\n    </div>\n</li>   \n',

                props: ['selectoption'],

                watch: {
                    "selectoption.text": function(value) {
                        this.selectoption.value = _.escape(_.snakeCase(value));
                    }

                }
            }

        }
   };

</script>
