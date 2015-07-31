module.exports = {

    methods: {
        getProfilevalue: function (defaultValue) {
            var index = _.findIndex(this.profilevalues, 'field_id', this.field.id),
                defaultProfilevalue = {
                    id: 0,
                    user_id: this.user.id,
                    field_id: this.field.id,
                    multiple: this.field.data.multiple || 0,
                    value: defaultValue
                };
            if (index === -1) {
                index = this.profilevalues.length;
                this.profilevalues.push(defaultProfilevalue);
            }
            //multiple setting changed, convert value
            if (this.field.data.multiple && this.profilevalues[index].multiple != this.field.data.multiple) {

                this.profilevalues[index].multiple = this.field.data.multiple;

                if (typeof this.profilevalues[index].value === 'object' && !this.profilevalues[index].multiple) {
                    this.profilevalues[index].value = this.profilevalues[index].value[0];
                }
                if (typeof this.profilevalues[index].value !== 'object' && this.profilevalues[index].multiple) {
                    this.profilevalues[index].value = [this.profilevalues[index].value];
                }

            }
            return this.profilevalues[index];
        },
        fieldInvalid: function (form) {
            return form[this.fieldid].invalid;
        }

    },

    computed: {
        fieldRequired: function () {
            return this.field.data.required ? true : false;
        }
    }

};