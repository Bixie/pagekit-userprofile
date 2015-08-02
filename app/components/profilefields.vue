<template>

    <component v-if="!isAdmin" v-repeat="field: fields | orderBy 'priority'" is="{{ field.type }}"></component>

    <component v-if="isAdmin" is="{{ editField }}" is-admin="true"></component>

</template>

<script>
var fieldOptions;
window.Profilefields = module.exports = {

    props: ['fields', 'editField'],

    inherit: true,

    components: {},

    computed: {
        isAdmin: function () {
            return !!this.editField
        }
    }

};

Vue.component('profilefields', function (resolve) {
    resolve(module.exports);
});

</script>

