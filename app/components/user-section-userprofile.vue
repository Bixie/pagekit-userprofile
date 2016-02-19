<template>
    <div>

        <fieldtypes class="uk-margin" :fields="fields"
                    :model.sync="profilevalues"
                    :user="user"
                    :form="form"></fieldtypes>


        <p v-show="!fields" class="uk-text-center"><i class="uk-icon-spinner uk-icon-spin"></i></p>

    </div>
</template>

<script>

    module.exports = {

        props: ['user', 'config', 'form'],

        data: function () {
            return window.$userprofile;
        },

        section: {
            label: 'Userprofile',
            priority: 200
        },

        events: {
            'save': function (data) {
                data.profilevalues = this.profilevalues;
            }
        }

    };

    window.User.components['user-section-userprofile:profile'] = module.exports;

</script>
