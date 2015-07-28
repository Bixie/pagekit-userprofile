<template>

    <div class="uk-form-row">
        <label for="{{ fieldid }}" class="uk-form-label">{{ field.label | trans }}</label>
        <div class="uk-form-controls">
            <input id="{{ fieldid }}" type="text" class="uk-form-width-large" v-model="value" />
        </div>
    </div>

</template>

<script>
    var fieldid;

    module.exports = {

        field: {
            type: 'text',
            hasOptions: false
        },

        props: ['field'],

        computed: {
            fieldid: function () {
                return fieldid || 'random';
            }
        }

    };

</script>
