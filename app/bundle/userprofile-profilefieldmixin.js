var ProfilefieldMixin =
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
/******/ ([
/* 0 */
/***/ function(module, exports) {

	module.exports = window.ProfilefieldMixin = {

	    props: ['isAdmin', 'profilevalues', 'user', 'field', 'form'],

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
	                    value: defaultValue,
	                    prepared: this.field.prepared
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
	        fieldInvalid: function () {
	            return this.form[this.fieldid].invalid;
	        },
	        classes: function (classes_array, classes_string) {
	            return (classes_array || []).concat(String(classes_string || '').split(' '));
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

/***/ }
/******/ ]);