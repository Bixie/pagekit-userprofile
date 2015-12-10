<template>

    <div v-if="isAdmin && field.data.multiple" class="uk-form-row">
        <label for="form-size" class="uk-form-label">{{ 'Size' | trans }}</label>

        <div class="uk-form-controls">
            <input id="form-size" class="uk-form-width-small uk-text-right" type="number" min="1"
                   v-model="field.data.size" number>
        </div>
    </div>

    <div class="uk-form-row {{field.data.classSfx}}">
        <label :for="fieldid" class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans
            }}</label>

        <div class="uk-form-controls">

            <select v-if="field.data.multiple" class="uk-form-width-large" multiple="multiple"
                    :attr="{name: fieldid, id: fieldid, size:field.data.size > 1 ? field.data.size : false, required: fieldRequired}"
                    v-model="dataObject.value">
                <option v-for="option in field.options" :value="option.value">{{ option.text }}</option>
            </select>

            <select v-if="!field.data.multiple" class="uk-form-width-large"
                    :attr="{name: fieldid, id: fieldid, size:(field.data.size > 1 ? field.data.size : false), required: fieldRequired}"
                    v-model="dataObject.value">
                <option v-for="option in field.options" :value="option.value">{{ option.text }}</option>
            </select>

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
                dataObject: {},
                fieldid: _.uniqueId('field_')
            };
        },

        created: function () {
            var defaultValue = this.field.data.multiple ? [] : this.field.options.length ? this.field.options[0].value : '';
            this.$set('dataObject', this.getDataObject(this.field.data.value || defaultValue));
        }

    };

    window.Profilefields.components['pulldown'] = module.exports;

</script>
