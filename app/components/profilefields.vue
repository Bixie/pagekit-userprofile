<template>

    <component v-if="!isAdmin" v-repeat="field: fields | orderBy 'priority'" is="{{ field.type }}"></component>

    <component v-if="isAdmin" is="{{ editField }}" is-admin="true"></component>
</template>

<script>

window.Profilefields = module.exports = {

    props: ['fields', 'editField'],

    inherit: true,

    components: {},

    computed: {
        isAdmin: function () {
            return !!this.editField
        }
    },

    getFieldoptions: function () {
        var options = {};
        _.forEach(window.Profilefields.components, function (field) {
            options[field.fieldOptions.type] = field.fieldOptions;
        });
        return options;
    }

};

Vue.component('profilefields', function (resolve) {
    resolve(module.exports);
});

</script>

