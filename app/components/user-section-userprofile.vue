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
            return {
                fields: [],
                profilevalues: {}
            }
        },

        section: {
            label: 'Userprofile',
            priority: 200
        },

        created: function () {
            this.Fields = this.$resource('api/userprofile/profile/{id}');
            this.load();
            this.$on('save', function (data) {
                data.profilevalues = this.profilevalues;
            });
        },

        methods: {

            load: function () {
                return this.Fields.query({id: this.user.id}).then(function (res) {
                    this.$set('fields', res.data.fields);
                    this.$set('profilevalues', res.data.profilevalues);
                }, function (res) {
                    this.$notify('Userprofile: ' + res.data, 'danger');
                });
            }
        }

    };

    window.User.components['user-section-userprofile:profile'] = module.exports;

</script>
