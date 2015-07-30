<template>

    <div class="uk-form-row">
        <label for="{{ fieldid }}" class="uk-form-label" v-show="!field.data.hide_label">{{ field.label | trans }}</label>
        <div class="uk-form-controls">
            <select id="{{ fieldid }}" class="uk-form-width-large"
                    options="field.options"
                    v-model="profilevalue.value"></select>
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
