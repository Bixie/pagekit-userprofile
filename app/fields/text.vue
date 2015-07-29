<template>

    <div class="uk-form-row">
        <label for="{{ fieldid }}" class="uk-form-label">{{ field.label | trans }}</label>
        <div class="uk-form-controls">
            <input type="text" class="uk-form-width-large"
                   v-attr="name: fieldid, id: fieldid"
                   v-model="profilevalue.value"
                   v-valid="required: {{ fieldRequired }}" />
            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ field.data.requiredError | trans }}</p>
        </div>
    </div>

</template>

<script>
    var profilefieldMixin = require('../mixins/profilefield.js');

    module.exports = {

        fieldOptions: {
            type: 'text',
            hasOptions: false
        },

        inherit: true,

        props: ['profilevalue'],

        data: function () {
            return {
                fieldid: _.uniqueId('profilefield_')
            };
        },

        ready: function () {
            this.$set('profilevalue', this.getProfilevalue(''));
        },

        mixins: [profilefieldMixin]

    };

</script>
