<template>
    <div>
        <component v-for="field in fields | orderBy 'priority'"
                   :is="field.type"
                   :is-admin="isAdmin"
                   :profilevalues="profilevalues"
                   :user="user"
                   :field="field"
                   :form="form"></component>
    </div>
</template>

<script>
var fieldOptions;
window.Profilefields = module.exports = {

    props: ['fields', 'field', 'profilevalues', 'user', 'editType', 'form'],

    components: {},

    computed: {
        isAdmin: function () {
            return !!this.editType
        }
    }

};

Vue.component('profilefields', function (resolve) {
    resolve(module.exports);
});

</script>

