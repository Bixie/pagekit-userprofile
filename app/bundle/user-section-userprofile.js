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

	module.exports = __webpack_require__(25)
	module.exports.template = __webpack_require__(26)


/***/ },

/***/ 25:
/***/ function(module, exports) {

	module.exports = {

	        section: {
	            label: 'Userprofile',
	            priority: 200
	        },

	        inherit: true,

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

	    window.Users.components['user-section-userprofile'] = module.exports;

/***/ },

/***/ 26:
/***/ function(module, exports) {

	module.exports = "<profilefields fields=\"{{@ fields}}\"></profilefields>\r\n\r\n    <p v-show=\"!fields\" class=\"uk-text-center\"><i class=\"uk-icon-spinner uk-icon-spin\"></i></p>";

/***/ }

/******/ });