<template>

    <div class="uk-form-horizontal">

        <partial name="settings"></partial>

    </div>

</template>

<script>

    module.exports = {

        inherit: true,

        section: {
            label: 'Settings',
            priority: 0,
            active: 'userprofile$'
        }

    };

    window.Site.components['userprofile'] = module.exports;

</script>
