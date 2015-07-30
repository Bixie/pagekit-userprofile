<template>

    <div class="uk-form-row">
        <label for="{{ fieldid }}" class="uk-form-label" v-show="!field.data.hide_label">{{ field.label | trans }}</label>
        <div class="uk-form-controls">
            <select class="uk-form-width-large"
                    options="field.options"
                    v-attr="name: fieldid, id: fieldid"
                    v-model="profilevalue.value"
                    v-valid="required: true"></select>
            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ field.data.requiredError || 'Please select a value' | trans }}</p>
        </div>
    </div>

</template>

<script>
    var profilefieldMixin = require('../mixins/profilefield.js'),
        fieldid;

    module.exports = {

        fieldOptions: {
            type: 'pulldown',
            hasPlaceholder: false,
            hasOptions: true
        },

        inherit: true,

        props: ['profilevalue'],

        mixins: [profilefieldMixin],

        data: function () {
            return {
                fieldid: _.uniqueId('field_')
            };
        },

        ready: function () {
            this.$set('profilevalue', this.getProfilevalue(this.field.options[0].value));
        }

    };

</script>
