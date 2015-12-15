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

	module.exports = __webpack_require__(22)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(23)
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\fieldtypes\\text\\text.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
	  }
	})()}

/***/ },

/***/ 22:
/***/ function(module, exports) {

	'use strict';

	// <template>

	//     <div :class="classes(['uk-form-row'], field.data.classSfx)">
	//         <label :for="fieldid" class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}</label>

	//         <div class="uk-form-controls">
	//             <input type="text" class="uk-form-width-large" placeholder="{{ field.data.placeholder || '' | trans }}"
	//                    :name="fieldid" :id="fieldid"
	//                    v-model="dataObject.value"
	//                    v-validate:required="fieldRequired">

	//             <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ field.data.requiredError ||
	//                 'Please enter a value' | trans }}</p>
	//         </div>
	//     </div>

	// </template>

	// <script>

	module.exports = {

	    mixins: [ProfilefieldMixin],

	    settings: {
	        'placeholder': {
	            type: 'text',
	            label: 'Placeholder',
	            attrs: { 'class': 'uk-form-width-large' }
	        }
	    },

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

	window.Profilefields.components['text'] = module.exports;

	// </script>

/***/ },

/***/ 23:
/***/ function(module, exports) {

	module.exports = "<div :class=\"classes(['uk-form-row'], field.data.classSfx)\">\n        <label :for=\"fieldid\" class=\"uk-form-label\" v-show=\"!field.data.hide_label\">{{ fieldLabel | trans }}</label>\n\n        <div class=\"uk-form-controls\">\n            <input type=\"text\" class=\"uk-form-width-large\" placeholder=\"{{ field.data.placeholder || '' | trans }}\"\n                   :name=\"fieldid\" :id=\"fieldid\"\n                   v-model=\"dataObject.value\"\n                   v-validate:required=\"fieldRequired\">\n\n            <p class=\"uk-form-help-block uk-text-danger\" v-show=\"fieldInvalid(form)\">{{ field.data.requiredError ||\n                'Please enter a value' | trans }}</p>\n        </div>\n    </div>";

/***/ }

/******/ });