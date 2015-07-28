<template>

    <div class="uk-form-row">
        <label for="{{ fieldid }}" class="uk-form-label">{{ 'Text' | trans }}</label>
        <div class="uk-form-controls">
            <input id="{{ fieldid }}" type="text" class="uk-form-width-large" v-model="value" />
        </div>
    </div>

</template>

<script>

    module.exports = {

        field: {
            type: 'select',
            hasOptions: true
        },

        props: ['field'],

        computed: {
            fieldid: function () {
                return fieldid || 'random';
            }
        }

    };

</script>
