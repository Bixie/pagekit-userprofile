<template>

    <div class="uk-form-row {{field.data.classSfx}}">
        <label for="{{ fieldid }}" class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans
            }}</label>

        <div class="uk-form-controls">
            <input type="text" class="uk-form-width-large" placeholder="{{ field.data.placeholder || '' | trans }}"
                   v-attr="name: fieldid, id: fieldid"
                   v-model="dataObject.value"
                   v-valid="required: fieldRequired"/>

            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ field.data.requiredError ||
                'Please enter a value' | trans }}</p>
        </div>
    </div>

</template>

<script>
    var profilefieldMixin = require('../mixins/profilefield.js');

    module.exports = {

        fieldOptions: {
            type: 'text',
            dataFields: {'placeholder': ''}
        },

        inherit: true,

        mixins: [profilefieldMixin],

        data: function () {
            return {
                fieldid: _.uniqueId('profilefield_')
            };
        },

        created: function () {
            this.$set('dataObject', this.getDataObject(this.field.data.value || ''));
        }

    };

    window.Profilefields.components['text'] = module.exports;

</script>
