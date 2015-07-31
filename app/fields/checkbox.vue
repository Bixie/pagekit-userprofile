<template>

    <div class="uk-form-row {{field.data.classSfx}}">
        <label for="{{ fieldid }}" class="uk-form-label" v-show="!field.data.hide_label">{{ field.label | trans
            }}</label>

        <div class="uk-form-controls uk-form-controls-text">
            <p v-repeat="option: field.options" class="uk-form-controls-condensed">
                <label><input type="checkbox" value="{{ option.value }}"
                              v-checkbox="profilevalue.value"> {{ option.text }}</label>
            </p>
            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ field.data.requiredError ||
                'Please select a value' | trans }}</p>
        </div>
    </div>

</template>

<script>
    var profilefieldMixin = require('../mixins/profilefield.js');

    module.exports = {

        fieldOptions: {
            type: 'checkbox',
            hasOptions: true,
            dataFields: {'multiple': true}
        },

        inherit: true,

        mixins: [profilefieldMixin],

        data: function () {
            return {
                fieldid: _.uniqueId('field_')
            };
        },

        created: function () {
            this.$set('profilevalue', this.getProfilevalue([]));
            this.$on('save', function (field) {
                field.data.required = false; //todo
                field.data.multiple = true;
            });
        }

    };

    window.Profilefields.components['checkbox'] = module.exports;

</script>
