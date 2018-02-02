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
/*global _ */
const UserUserprofile = {

    name: 'UserUserprofile',

    section: {
        label: 'Userprofile',
        priority: 200,
    },

    props: {'user': Object, 'config': Object, 'form': Object,},

    data: () => _.merge({}, window.$userprofile),

    events: {
        'save'(data) {
            data.profilevalues = this.profilevalues;
        },
    },

};

window.User.components['user-section-userprofile:profile'] = UserUserprofile;
//needs to be exported to compile template
export default UserUserprofile;

</script>
