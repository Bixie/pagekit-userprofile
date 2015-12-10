<template>
    <div>

        <component v-if="!isAdmin" v-for="field in fields | orderBy 'priority'"
                   :is="field.type"
                   :profilevalues="profilevalues"
                   :user="user"
                   :field="field"
                   :form="form"></component>

        <component v-if="isAdmin" :is="editField"
                   :is-admin="true"
                   :editField="editField"
                   :profilevalues="profilevalues"
                   :user="user"
                   :field="field"
                   :form="form"></component>

    </div>
</template>

<script>
var fieldOptions;
window.Profilefields = module.exports = {

    props: ['fields', 'field', 'profilevalues', 'user', 'editField', 'form'],

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

