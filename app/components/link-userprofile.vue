<template>

    <div class="uk-form-row">
        <label for="form-link-userprofile" class="uk-form-label">{{ 'View' | trans }}</label>
        <div class="uk-form-controls">
            <select id="form-link-userprofile" class="uk-width-1-1" v-model="link">
                <option value="@userprofile">{{ 'User Profile' | trans }}</option>
                <option value="@userprofile/profiles">{{ 'User Profiles List' | trans }}</option>
                <option value="@userprofile/registration">{{ 'User Registration' | trans }}</option>
            </select>
        </div>
    </div>

</template>

<script>

    module.exports = {

        link: {
            label: 'Userprofile'
        },

        props: ['link'],

        ready: function () {
            this.$set('link', '@userprofile');
        }

    };

    window.Links.components['userprofile'] = module.exports;

</script>
