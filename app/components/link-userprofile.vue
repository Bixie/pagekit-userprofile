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

    const LinkUserprofile = {

        name: 'LinkUserprofile',

        link: {
            label: 'Userprofile',
        },

        props: {'link': String,},

        ready() {
            this.link  = '@userprofile';
        },

    };

    window.Links.components['userprofile'] = LinkUserprofile;
    export default LinkUserprofile;

</script>
