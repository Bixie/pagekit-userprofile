<template>

    <div class="uk-form-row {{field.data.classSfx}}">
        <span class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}</span>

        <div class="uk-form-controls uk-form-controls-text">
            <p v-repeat="option: field.options" class="uk-form-controls-condensed">
                <label><input type="radio" value="{{ option.value }}"
                              v-model="dataObject.value"> {{ option.text }}</label>
            </p>
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
        }

    };

    window.Profilefields.components['radio'] = module.exports;

</script>
