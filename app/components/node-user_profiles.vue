<template>

    <div class="uk-form-horizontal">

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Page Title' | trans }}</label>
            <div class="uk-form-controls">
                <input class="uk-form-width-large" type="text" name="title" v-model="node.data.page_title">
            </div>
        </div>

        <div class="uk-form-row">
            <span class="uk-form-label">{{ 'Show user groups' | trans }}</span>
            <div class="uk-form-controls uk-form-controls-text">
                <p v-for="role in roles" class="uk-form-controls-condensed">
                    <label><input type="checkbox" :value="role.id" v-model="node.data.show_roles" number> {{ role.name }}</label>
                </p>
                <p class="uk-form-help-block">{{ 'Leave unselected to show all' | trans }}</p>
            </div>
        </div>

        <div class="uk-form-row">
            <span class="uk-form-label">{{ 'Search' | trans }}</span>
            <div class="uk-form-controls uk-form-controls-text">
                <label><input type="checkbox" value="center-content" v-model="node.data.show_search"> {{ 'Show search input' | trans }}</label>
            </div>
        </div>

    </div>

</template>

<script>

    module.exports = {

        section: {
            label: 'List config',
            priority: 50
        },

        props: ['node'],

        data() {
            return {
                roles: _.filter(window.$data.roles, role => !role.anonymous)
            };
        },

        created() {
            this.node.data.show_roles = this.node.data.show_roles || [];
            this.node.link = `@userprofile/profiles/${this.node.slug}`;
        },

        watch: {
            'node.slug': function (slug) {
                this.node.link = `@userprofile/profiles/${slug}`;
            }
        }

    };

    window.Site.components['user-profiles:config'] = module.exports;

</script>
