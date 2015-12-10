var Profilefields =
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
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(2)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(3)
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\app\\components\\profilefields.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
	  }
	})()}

/***/ },
/* 1 */,
/* 2 */
/***/ function(module, exports) {

	'use strict';

	// <template>
	//     <div>

	//         <component v-if="!isAdmin" v-for="field in fields | orderBy 'priority'"
	//                    :is="field.type"
	//                    :profilevalues="profilevalues"
	//                    :user="user"
	//                    :field="field"
	//                    :form="form"></component>

	//         <component v-if="isAdmin" :is="editField"
	//                    :is-admin="true"
	//                    :editField="editField"
	//                    :profilevalues="profilevalues"
	//                    :user="user"
	//                    :field="field"
	//                    :form="form"></component>

	//     </div>
	// </template>

	// <script>
	var fieldOptions;
	window.Profilefields = module.exports = {

	    props: ['fields', 'field', 'profilevalues', 'user', 'editField', 'form'],

	    components: {},

	    computed: {
	        isAdmin: function isAdmin() {
	            return !!this.editField;
	        }
	    }

	};

	Vue.component('profilefields', function (resolve) {
	    resolve(module.exports);
	});

	// </script>

/***/ },
/* 3 */
/***/ function(module, exports) {

	module.exports = "<div>\n\n        <component v-if=\"!isAdmin\" v-for=\"field in fields | orderBy 'priority'\"\n                   :is=\"field.type\"\n                   :profilevalues=\"profilevalues\"\n                   :user=\"user\"\n                   :field=\"field\"\n                   :form=\"form\"></component>\n\n        <component v-if=\"isAdmin\" :is=\"editField\"\n                   :is-admin=\"true\"\n                   :editField=\"editField\"\n                   :profilevalues=\"profilevalues\"\n                   :user=\"user\"\n                   :field=\"field\"\n                   :form=\"form\"></component>\n\n    </div>";

/***/ }
/******/ ]);