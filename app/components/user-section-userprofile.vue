<template>
    <div>

        <profilefields :fields.sync="fields" :profilevalues="profilevalues" :user="user" :form="form"></profilefields>

        <p v-show="!fields" class="uk-text-center"><i class="uk-icon-spinner uk-icon-spin"></i></p>

    </div>
</template>

<script>

    module.exports = {

        props: ['user', 'config', 'form'],

        data: function () {
            return {
                fields: [],
                profilevalues: []
            }
        },

        section: {
            label: 'Userprofile',
            priority: 200
        },

        created: function () {
            this.Fields = this.$resource('api/userprofile/profile/:id');
            this.load();
            this.$on('save', function (data) {
                data.profilevalues = this.profilevalues;
            });
        },

        methods: {

            load: function () {
                return this.Fields.query({id: this.user.id}, function (data) {
                    this.$set('fields', data.fields);
                    this.$set('profilevalues', data.profilevalues);
                }, function (message) {
                    this.$notify('Userprofile: ' + message, 'danger');
                });
            }
        }

    };

    window.User.components['user-section-userprofile:profile'] = module.exports;

</script>
