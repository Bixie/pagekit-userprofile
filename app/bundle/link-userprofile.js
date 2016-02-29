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

	var __vue_script__, __vue_template__
	__vue_script__ = __webpack_require__(10)
	__vue_template__ = __webpack_require__(11)
	module.exports = __vue_script__ || {}
	if (module.exports.__esModule) module.exports = module.exports.default
	if (__vue_template__) { (typeof module.exports === "function" ? module.exports.options : module.exports).template = __vue_template__ }
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\app\\components\\link-userprofile.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, __vue_template__)
	  }
	})()}

/***/ },

/***/ 10:
/***/ function(module, exports) {

	'use strict';

	// <template>
	//
	//     <div class="uk-form-row">
	//         <label for="form-link-userprofile" class="uk-form-label">{{ 'View' | trans }}</label>
	//         <div class="uk-form-controls">
	//             <select id="form-link-userprofile" class="uk-width-1-1" v-model="link">
	//                 <option value="@userprofile">{{ 'User Profile' | trans }}</option>
	//                 <option value="@userprofile/registration">{{ 'User Registration' | trans }}</option>
	//             </select>
	//         </div>
	//     </div>
	//
	// </template>
	//
	// <script>

	module.exports = {

	    link: {
	        label: 'Userprofile'
	    },

	    props: ['link'],

	    ready: function ready() {
	        this.$set('link', '@userprofile');
	    }

	};

	window.Links.components['userprofile'] = module.exports;

	// </script>
	//

/***/ },

/***/ 11:
/***/ function(module, exports) {

	module.exports = "\n\n    <div class=\"uk-form-row\">\n        <label for=\"form-link-userprofile\" class=\"uk-form-label\">{{ 'View' | trans }}</label>\n        <div class=\"uk-form-controls\">\n            <select id=\"form-link-userprofile\" class=\"uk-width-1-1\" v-model=\"link\">\n                <option value=\"@userprofile\">{{ 'User Profile' | trans }}</option>\n                <option value=\"@userprofile/registration\">{{ 'User Registration' | trans }}</option>\n            </select>\n        </div>\n    </div>\n\n";

/***/ }

/******/ });