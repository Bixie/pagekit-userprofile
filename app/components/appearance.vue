<template>

    <div class="uk-form-horizontal">

        <div class="uk-form-row">
            <span class="uk-form-label">{{ 'Label' | trans }}</span>
            <div class="uk-form-controls uk-form-controls-text">
                <label><input type="checkbox" value="hide-label" v-model="field.data.hide_label"> {{ 'Hide Label' | trans }}</label>
            </div>
        </div>

        <div class="uk-form-row" v-show="fieldOption('size') && field.data.multiple">
            <label for="form-placeholder" class="uk-form-label">{{ 'Size' | trans }}</label>
            <div class="uk-form-controls">
                <input id="form-size" class="uk-form-width-small uk-text-right" type="number" min="1" v-model="field.data.size" number>
            </div>
        </div>

        <div class="uk-form-row">
            <label for="form-class" class="uk-form-label">{{ 'Class' | trans }}</label>
            <div class="uk-form-controls">
                <input id="form-class" class="uk-form-width-large" type="text" v-model="field.data.class">
            </div>
        </div>

        <div class="uk-form-row" v-show="field.data.required">
            <label for="form-required-error" class="uk-form-label">{{ 'Required error message' | trans }}</label>
            <div class="uk-form-controls">
                <input id="form-required-error" class="uk-form-width-large" type="text" v-model="field.data.requiredError">
            </div>
        </div>

    </div>

</template>

<script>

    module.exports = {

        inherit: true,

        props: ['field']

    };

</script>
