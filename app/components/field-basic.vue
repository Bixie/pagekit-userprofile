<template>

    <div class="uk-form-horizontal uk-margin">

        <div class="uk-form-row">
            <label for="form-label" class="uk-form-label">{{ 'Label' | trans }}</label>
            <div class="uk-form-controls">
                <input id="form-label" class="uk-form-width-large" type="text" v-model="field.label">
            </div>
        </div>

        <div class="uk-form-row" v-show="hasPlaceholder">
            <label for="form-placeholder" class="uk-form-label">{{ 'Placeholder' | trans }}</label>
            <div class="uk-form-controls">
                <input id="form-placeholder" class="uk-form-width-large" type="text" v-model="field.data.placeholder">
            </div>
        </div>

        <div class="uk-form-row">
            <span class="uk-form-label">{{ 'Field required' | trans }}</span>
            <div class="uk-form-controls uk-form-controls-text">
                <label><input type="checkbox" value="required" v-model="field.data.required"> {{ 'Required' | trans }}</label>
            </div>
        </div>
        <input type="hidden" v-model="field.priority"/>
    </div>

</template>

<script>

    module.exports = {

        inherit: true,

        props: ['field']

    };

</script>
