
var options = require('./options');

module.exports = {
    list: {
        'profiles_per_page': {
            type: 'number',
            label: 'Profiles per page',
            attrs: {'class': 'uk-form-width-small'}
        },
        'columns': {
            type: 'select',
            label: 'Phone Portrait',
            options: options.gridcols.base,
            attrs: {'class': 'uk-form-width-small'}
        },
        'columns_small': {
            type: 'select',
            label: 'Phone Landscape',
            options: options.gridcols.inherit,
            attrs: {'class': 'uk-form-width-small'}
        },
        'columns_medium': {
            type: 'select',
            label: 'Tablet',
            options: options.gridcols.inherit,
            attrs: {'class': 'uk-form-width-small'}
        },
        'columns_large': {
            type: 'select',
            label: 'Desktop',
            options: options.gridcols.inherit,
            attrs: {'class': 'uk-form-width-small'}
        },
        'columns_xlarge': {
            type: 'select',
            label: 'Large screens',
            options: options.gridcols.inherit,
            attrs: {'class': 'uk-form-width-small'}
        },
        'panel_style': {
            type: 'select',
            label: 'Panel style',
            options: options.panel_style,
            attrs: {'class': 'uk-form-width-medium'}
        },
        'show_title': {
            type: 'select',
            label: 'Show title',
            options: {
                'Hide': 'none', /*trans*/
                'Username': 'username', /*trans*/
                'Name': 'name' /*trans*/
            },
            attrs: {'class': 'uk-form-width-medium'}
        },
        'title_size': {
            type: 'select',
            label: 'Title size',
            options: options.heading_size,
            attrs: {'class': 'uk-form-width-medium'}
        },
        'title_color': {
            type: 'select',
            label: 'Title color',
            options: options.text_color,
            attrs: {'class': 'uk-form-width-medium'}
        }
    },
    details: {
        'show_email': {
            type: 'checkbox',
            label: 'Email',
            optionlabel: 'Show email address'
        },
        'show_image': {
            type: 'checkbox',
            label: 'Image',
            optionlabel: 'Show gravatar image'
        },
        'show_username': {
            type: 'checkbox',
            label: 'Username',
            optionlabel: 'Show username'
        }
    },
    general: {
        'override_registration': {
            type: 'checkbox',
            label: 'Override registration',
            optionlabel: 'Redirect Pagekit registration page'
        }
    }


};