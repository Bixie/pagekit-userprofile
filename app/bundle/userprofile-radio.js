var Fields =
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(34)
	module.exports.template = __webpack_require__(35)


/***/ },

/***/ 28:
/***/ function(module, exports) {

	module.exports = {

	    props: ['isAdmin'],

	    methods: {
	        getDataObject: function (defaultValue) {
	            if (this.isAdmin) {
	                this.field.data.value = this.field.data.value || defaultValue;
	                return this.field.data;
	            }
	            return this.getProfilevalue(defaultValue);
	        },
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
	            return this.field.data.required && !this.isAdmin ? true : false;
	        },
	        fieldLabel: function () {
	            return this.isAdmin ? 'Default value' : this.field.label;
	        }
	    }

	};

/***/ },

/***/ 34:
/***/ function(module, exports, __webpack_require__) {

	var profilefieldMixin = __webpack_require__(28);

	    module.exports = {

	        inherit: true,

	        mixins: [profilefieldMixin],

	        data: function () {
	            return {
	                fieldid: _.uniqueId('field_')
	            };
	        },

	        created: function () {
	            this.$set('dataObject', this.getDataObject(this.field.data.value || []));
	        }

	    };

	    window.Profilefields.components['radio'] = module.exports;

/***/ },

/***/ 35:
/***/ function(module, exports) {

	module.exports = "<div class=\"uk-form-row {{field.data.classSfx}}\">\r\n        <span class=\"uk-form-label\" v-show=\"!field.data.hide_label\">{{ fieldLabel | trans }}</span>\r\n\r\n        <div class=\"uk-form-controls uk-form-controls-text\">\r\n            <p v-repeat=\"option: field.options\" class=\"uk-form-controls-condensed\">\r\n                <label><input type=\"radio\" value=\"{{ option.value }}\"\r\n                              v-model=\"dataObject.value\"> {{ option.text }}</label>\r\n            </p>\r\n        </div>\r\n    </div>";

/***/ }

/******/ });