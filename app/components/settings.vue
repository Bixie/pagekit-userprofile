<template>

    <div class="uk-form uk-form-horizontal">

        <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
            <div data-uk-margin>

                <h2 class="uk-margin-remove">{{ 'Userprofile Settings' | trans }}</h2>

            </div>
            <div data-uk-margin>

                <button class="uk-button uk-modal-close">{{ 'Close' | trans }}</button>

                <button class="uk-button uk-button-primary uk-margin-small-left" @click="save">{{ 'Save' | trans }}</button>

            </div>
        </div>

        <div class="uk-form-row">
            <span class="uk-form-label">{{ 'Redirect' | trans }}</span>

            <div class="uk-form-controls uk-form-controls-text">
                <label><input type="checkbox" value="override_registration" v-model="package.config.override_registration">
                    {{ 'Redirect Pagekit registration page' | trans }}</label>
            </div>
        </div>

    </div>

</template>

<script>

    module.exports = {

        props: ['package'],

        settings: true,

        methods: {

            save: function () {
                this.$http.post('admin/system/settings/config', {
                        name: 'bixie/userprofile',
                        config: this.package.config
                    }).then(function () {
                        this.$notify('Settings saved.', '');
                    }, function (res) {
                        this.$notify(res.data, 'danger');
                    }
                );
            }

        }

    };

    window.Extensions.components['settings-userprofile'] = module.exports;

</script>
