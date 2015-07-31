<template>hoi
    <component v-repeat="field: fields | orderBy 'priority'" is="{{ field.type }}"></component>
</template>

<script>

window.Profilefields = module.exports = {

    props: ['fields'],

    inherit: true,

    components: {},

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

