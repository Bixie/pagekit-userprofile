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

	module.exports = __webpack_require__(13)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(17)
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\fieldtypes\\htmlcode\\htmlcode.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
	  }
	})()}

/***/ },
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */,
/* 5 */,
/* 6 */,
/* 7 */,
/* 8 */,
/* 9 */,
/* 10 */,
/* 11 */,
/* 12 */,
/* 13 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	// <template>

	//     <div :class="['uk-form-row', isAdmin ? 'uk-hidden' : '', field.data.classSfx || '']">

	//         {{{ dataObject.prepared }}}

	//     </div>

	// </template>

	// <script>

	module.exports = {

	    mixins: [ProfilefieldMixin],

	    settings: __webpack_require__(14),

	    appearance: {},

	    data: function data() {
	        return {
	            dataObject: {},
	            fieldid: _.uniqueId('userprofilefield_')
	        };
	    },

	    created: function created() {
	        this.$set('dataObject', this.getDataObject(this.field.data.value || ''));
	    }

	};

	window.Profilefields.components['htmlcode'] = module.exports;

	// </script>

/***/ },
/* 14 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(15)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(16)
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\fieldtypes\\htmlcode\\components\\settings.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
	  }
	})()}

/***/ },
/* 15 */
/***/ function(module, exports) {

	'use strict';

	// <template>

	//     <div class="uk-form-row">

	//         <v-editor :value.sync="field.data.value" :options="{markdown : field.data.markdown}"></v-editor>

	//         <p>

	//             <label><input type="checkbox" v-model="field.data.markdown"> {{ 'Enable Markdown' | trans }}</label>

	//         </p>

	//     </div>

	// </template>

	// <script>

	module.exports = {

	    created: function created() {
	        this.field.data = _.merge({
	            'markdown': false
	        }, this.field.data);
	    }

	};

	// </script>

/***/ },
/* 16 */
/***/ function(module, exports) {

	module.exports = "<div class=\"uk-form-row\">\r\n\r\n        <v-editor :value.sync=\"field.data.value\" :options=\"{markdown : field.data.markdown}\"></v-editor>\r\n        <p>\r\n            <label><input type=\"checkbox\" v-model=\"field.data.markdown\"> {{ 'Enable Markdown' | trans }}</label>\r\n        </p>\r\n\r\n    </div>";

/***/ },
/* 17 */
/***/ function(module, exports) {

	module.exports = "<div :class=\"['uk-form-row', isAdmin ? 'uk-hidden' : '', field.data.classSfx || '']\">\n\n        {{{ dataObject.prepared }}}\n\n    </div>";

/***/ }
/******/ ]);