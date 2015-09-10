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

	module.exports = __webpack_require__(26)
	module.exports.template = __webpack_require__(27)


/***/ },

/***/ 26:
/***/ function(module, exports) {

	module.exports = {

	        props: ['package'],

	        settings: true,

	        methods: {

	            save: function () {
	                this.$http.post('admin/system/settings/config', {
	                    name: 'userprofile',
	                    config: this.package.config
	                }, function () {
	                    this.$notify('Settings saved.', '');
	                }).error(function (data) {
	                    this.$notify(data, 'danger');
	                }).always(function () {
	                    this.$parent.close();
	                });
	            }

	        }

	    };

	    window.Extensions.components['settings-userprofile'] = module.exports;

/***/ },

/***/ 27:
/***/ function(module, exports) {

	module.exports = "<div class=\"uk-form uk-form-horizontal\">\n\n        <div class=\"uk-margin uk-flex uk-flex-space-between uk-flex-wrap\" data-uk-margin>\n            <div data-uk-margin>\n\n                <h2 class=\"uk-margin-remove\">{{ 'Userprofile Settings' | trans }}</h2>\n\n            </div>\n            <div data-uk-margin>\n\n                <button class=\"uk-button uk-button-primary\" v-on=\"click: save\">{{ 'Save' | trans }}</button>\n\n            </div>\n        </div>\n\n        <div class=\"uk-form-row\">\n            <span class=\"uk-form-label\">{{ 'Redirect' | trans }}</span>\n\n            <div class=\"uk-form-controls uk-form-controls-text\">\n                <label><input type=\"checkbox\" value=\"override_registration\" v-model=\"package.config.override_registration\">\n                    {{ 'Redirect Pagekit registration page' | trans }}</label>\n            </div>\n        </div>\n\n    </div>";

/***/ }

/******/ });