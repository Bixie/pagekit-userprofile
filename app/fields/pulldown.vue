<template>

    <div v-show="isAdmin && field.data.multiple" class="uk-form-row">
        <label for="form-placeholder" class="uk-form-label">{{ 'Size' | trans }}</label>

        <div class="uk-form-controls">
            <input id="form-size" class="uk-form-width-small uk-text-right" type="number" min="1"
                   v-model="field.data.size" number>
        </div>
    </div>

    <div class="uk-form-row {{field.data.classSfx}}">
        <label for="{{ fieldid }}" class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans
            }}</label>

        <div class="uk-form-controls">

            <select v-if="field.data.multiple" class="uk-form-width-large" multiple="multiple"
                    options="field.options"
                    v-attr="name: fieldid, id: fieldid, size:field.data.size > 1 ? field.data.size : false"
                    v-model="dataObject.value"
                    v-valid="required: fieldRequired"></select>

            <select v-if="!field.data.multiple" class="uk-form-width-large"
                    options="field.options"
                    v-attr="name: fieldid, id: fieldid, size:field.data.size > 1 ? field.data.size : false"
                    v-model="dataObject.value"
                    v-valid="required: fieldRequired"></select>

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
            this.$set('dataObject', this.getDataObject(this.field.data.value || this.field.data.multiple ? [] : this.field.options[0].value));
        }

    };

    window.Profilefields.components['pulldown'] = module.exports;

</script>
