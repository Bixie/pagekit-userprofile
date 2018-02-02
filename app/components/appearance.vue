<template>

    <div class="uk-form-horizontal">

        <partial name="fieldtype-appearance"></partial>

        <bixie-fields :config="appearanceSettings" :values.sync="field.data"></bixie-fields>

    </div>

</template>

<script>

export default  {

    name: 'FieldAppearance',

    props: {'field': Object,},

    computed: {
        appearanceSettings() {
            return this.field.type ? window.BixieFieldtypes.components[this.field.type].appearance ||
                    window.BixieFieldtypes.components[this.field.type].options.appearance : {};
        },
    },

};

</script>
