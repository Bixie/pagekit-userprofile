<template>

    <div class="uk-form-row {{field.data.classSfx}}">
        <label for="{{ fieldid }}" class="uk-form-label" v-show="!field.data.hide_label">{{ field.label | trans }}</label>
        <div class="uk-form-controls">
            <input type="text" class="uk-form-width-large" placeholder="{{ field.data.placeholder || '' | trans }}"
                   v-attr="name: fieldid, id: fieldid"
                   v-model="profilevalue.value"
                   v-valid="required: fieldRequired" />
            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ field.data.requiredError || 'Please enter a value' | trans }}</p>
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

        props: ['profilevalue'],

        mixins: [profilefieldMixin],

        data: function () {
            return {
                fieldid: _.uniqueId('profilefield_')
            };
        },

        ready: function () {
            this.$set('profilevalue', this.getProfilevalue(''));
        }

    };

</script>
