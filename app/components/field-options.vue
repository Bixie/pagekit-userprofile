<template>

    <div class="uk-form-horizontal">

        <div class="uk-form-row">
            <span class="uk-form-label">{{ 'Options' | trans }}</span>
            <div class="uk-form-controls uk-form-controls-text">
                <ul class="uk-nestable uk-margin-remove" v-el="optionsNestable" v-show="field.options.length">
                    <selectoption v-repeat="selectoption: field.options"></selectoption>
                </ul>
                <button type="button" class="uk-button uk-button-primary uk-button-small uk-margin" v-on="click: addFieldoption">{{ 'Add option' | trans}}</button>
            </div>
        </div>

    </div>
</template>

<script>

    module.exports = {

        props: ['field'],

        methods: {
            addFieldoption: function () {
                this.field.options.push({
                    value: '',
                    text: '',
                    invalid: false
                });
            },
            deleteFieldoption: function (idx) {
                console.log(idx);
                this.field.options.$remove(idx);
            },
            checkDuplicates: function () {
                var current, dups = [];
                _.sortBy(this.field.options, 'value').forEach(function (option) {
                    if (current && current === option.value) {
                        dups.push(option.value);
                    }
                    current = option.value;
                });
                this.field.options.forEach(function (option) {
                    option.invalid = dups.indexOf(option.value) > -1 ? 'Duplicate value' : false;
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

                template: '<li class="uk-nestable-item" data-value="{{ selectoption.value }}">\n    <div class="uk-nestable-panel uk-visible-hover uk-form uk-flex uk-flex-middle">\n        <div class="uk-flex-item-1">\n            <div class="uk-form-row">\n                <small class="uk-form-label uk-text-muted uk-text-truncate" style="text-transform: none" v-class="uk-text-danger: selectoption.invalid">{{ selectoption.value }}</small>\n                <div class="uk-form-controls">\n                    <input type="text" class="uk-form-width-large" v-model="selectoption.text"/></div>\n                <p class="uk-form-help-block uk-text-danger" v-show="selectoption.invalid">{{ selectoption.invalid | trans }}</p>\n\n            </div>\n        </div>\n        <div class="">\n            <ul class="uk-subnav pk-subnav-icon">\n                <li><a class="pk-icon-delete pk-icon-hover uk-invisible" v-on="click: deleteFieldoption($index)"></a></li>\n                <li><a class="pk-icon-move pk-icon-hover uk-invisible uk-nestable-handle"></a></li>\n            </ul>\n        </div>\n    </div>\n</li>   \n',

                inherit: true,

                watch: {
                    "selectoption.text": function(value) {
                        this.selectoption.value = _.escape(_.snakeCase(value));
                        this.checkDuplicates();
                    }

                }
            }

        }
   };

</script>
