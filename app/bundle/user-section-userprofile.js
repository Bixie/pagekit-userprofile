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

	module.exports = __webpack_require__(20)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(21)
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\app\\components\\user-section-userprofile.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
	  }
	})()}

/***/ },

/***/ 20:
/***/ function(module, exports) {

	'use strict';

	// <template>

	//     <div>

	//         <fieldtypes class="uk-margin" :fields="fields"

	//                     :model.sync="profilevalues"

	//                     :user="user"

	//                     :form="form"></fieldtypes>

	//         <p v-show="!fields" class="uk-text-center"><i class="uk-icon-spinner uk-icon-spin"></i></p>

	//     </div>

	// </template>

	// <script>

	module.exports = {

	    props: ['user', 'config', 'form'],

	    data: function data() {
	        return window.$userprofile;
	    },

	    section: {
	        label: 'Userprofile',
	        priority: 200
	    },

	    events: {
	        'save': function save(data) {
	            data.profilevalues = this.profilevalues;
	        }
	    }

	};

	window.User.components['user-section-userprofile:profile'] = module.exports;

	// </script>

/***/ },

/***/ 21:
/***/ function(module, exports) {

	module.exports = "<div>\r\n\r\n        <fieldtypes class=\"uk-margin\" :fields=\"fields\"\r\n                    :model.sync=\"profilevalues\"\r\n                    :user=\"user\"\r\n                    :form=\"form\"></fieldtypes>\r\n\r\n\r\n        <p v-show=\"!fields\" class=\"uk-text-center\"><i class=\"uk-icon-spinner uk-icon-spin\"></i></p>\r\n\r\n    </div>";

/***/ }

/******/ });