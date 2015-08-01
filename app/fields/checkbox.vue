<template>

    <div class="uk-form-row {{field.data.classSfx}}">
        <span class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}</span>

        <div class="uk-form-controls uk-form-controls-text">
            <p v-repeat="option: field.options" class="uk-form-controls-condensed">
                <label><input type="checkbox" value="{{ option.value }}"
                              v-checkbox="dataObject.value"> {{ option.text }}</label>
            </p>
            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ field.data.requiredError ||
                'Please select a value' | trans }}</p>
        </div>
    </div>

</template>

<script>
    var profilefieldMixin = require('../mixins/profilefield.js');

    module.exports = {

        inherit: true,

        mixins: [profilefieldMixin],

        data: function () {
            return {
                fieldid: _.uniqueId('field_')
            };
        },

        created: function () {
            this.$set('dataObject', this.getDataObject(this.field.data.value || []));
            this.$on('save', function (data) {
                data.field.data.required = false; //todo
                data.field.data.multiple = true;
            });
        }

    };

    window.Profilefields.components['checkbox'] = module.exports;

</script>
