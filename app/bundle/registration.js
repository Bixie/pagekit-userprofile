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
/******/ ([
/* 0 */
/***/ function(module, exports) {

	module.exports = {

	    el: '#userprofile-registration',

	    data: function () {
	        return _.merge({
	            error: '',
	            fields: [],
	            profilevalues: {},
	            user: {},
	            form: {}
	        }, window.$data);
	    },

	    created: function () {
	        //prepare values
	        this.fields.forEach(function (field) {
	            this.profilevalues[field.slug] = {
	                field_id: field.id,
	                slug: field.slug,
	                type: field.type,
	                label: field.label,
	                value: null,
	                field: field,
	                data: {value: null, id: 0}
	            };
	        }.bind(this));
	    },

	    methods: {

	        save: function () {

	            this.$set('error', '');

	            this.$http.post('user/registration/register', {
	                user: this.user,
	                profilevalues: this.profilevalues
	            }).then(function (res) {
	                window.location.replace(res.data.redirect);
	            }, function (res) {
	                this.error = res.data;
	            });
	        }

	    }

	};

	Vue.ready(module.exports);


/***/ }
/******/ ]);