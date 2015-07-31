<template>

    <div class="uk-form-row {{field.data.classSfx}}">
        <label for="{{ fieldid }}" class="uk-form-label" v-show="!field.data.hide_label">{{ field.label | trans
            }}</label>

        <div class="uk-form-controls">

            <select v-if="profilevalue.multiple" class="uk-form-width-large" multiple="multiple"
                    options="field.options"
                    v-attr="name: fieldid, id: fieldid, size:field.data.size > 1 ? field.data.size : false"
                    v-model="profilevalue.value"
                    v-valid="required: fieldRequired"></select>

            <select v-if="!profilevalue.multiple" class="uk-form-width-large"
                    options="field.options"
                    v-attr="name: fieldid, id: fieldid, size:field.data.size > 1 ? field.data.size : false"
                    v-model="profilevalue.value"
                    v-valid="required: fieldRequired"></select>

            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ field.data.requiredError ||
                'Please select a value' | trans }}</p>
        </div>
    </div>

</template>

<script>
    var profilefieldMixin = require('../mixins/profilefield.js'),
            fieldid;

    module.exports = {

        fieldOptions: {
            type: 'pulldown',
            hasOptions: true,
            dataFields: {'size': 1, 'multiple': false}
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
            this.$set('profilevalue', this.getProfilevalue(this.field.data.multiple ? [] : this.field.options[0].value));
        }

    };

</script>
