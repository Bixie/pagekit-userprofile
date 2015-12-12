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

	module.exports = __webpack_require__(11)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(12)
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\fieldtypes\\pulldown\\pulldown.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
	  }
	})()}

/***/ },

/***/ 11:
/***/ function(module, exports) {

	'use strict';

	// <template>

	//     <div class="uk-form-row {{field.data.classSfx || ''}}">
	//         <label :for="fieldid" class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}</label>

	//         <div class="uk-form-controls">

	//             <select v-if="field.data.multiple" class="uk-form-width-large" multiple="multiple"
	//                     v-bind="{name: fieldid, id: fieldid, size:field.data.size > 1 ? field.data.size : false}"
	//                     v-model="dataObject.value"
	//                     :required="fieldRequired">
	//                 <option v-for="option in field.options" :value="option.value">{{ option.text }}</option>
	//             </select>

	//             <select v-else class="uk-form-width-large"
	//                     v-bind="{name: fieldid, id: fieldid, size:field.data.size > 1 ? field.data.size : false}"
	//                     v-model="dataObject.value"
	//                     :required="fieldRequired">
	//                 <option v-for="option in field.options" :value="option.value">{{ option.text }}</option>
	//             </select>

	//             <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ field.data.requiredError ||
	//                 'Please select a value' | trans }}</p>
	//         </div>
	//     </div>

	// </template>

	// <script>

	module.exports = {

	    mixins: [ProfilefieldMixin],

	    settings: {},

	    appearance: {
	        'size': {
	            type: 'number',
	            label: 'Size',
	            attrs: { 'class': 'uk-form-width-small uk-text-right', 'min': 1 }
	        }
	    },

	    data: function data() {
	        return {
	            dataObject: {},
	            fieldid: _.uniqueId('userprofilefield_')
	        };
	    },

	    created: function created() {
	        var defaultValue = this.field.data.multiple ? [] : this.field.options.length ? this.field.options[0].value : '';
	        this.$set('dataObject', this.getDataObject(this.field.data.value || defaultValue));
	    }

	};

	window.Profilefields.components['pulldown'] = module.exports;

	// </script>

/***/ },

/***/ 12:
/***/ function(module, exports) {

	module.exports = "<div class=\"uk-form-row {{field.data.classSfx || ''}}\">\n        <label :for=\"fieldid\" class=\"uk-form-label\" v-show=\"!field.data.hide_label\">{{ fieldLabel | trans }}</label>\n\n        <div class=\"uk-form-controls\">\n\n            <select v-if=\"field.data.multiple\" class=\"uk-form-width-large\" multiple=\"multiple\"\n                    v-bind=\"{name: fieldid, id: fieldid, size:field.data.size > 1 ? field.data.size : false}\"\n                    v-model=\"dataObject.value\"\n                    :required=\"fieldRequired\">\n                <option v-for=\"option in field.options\" :value=\"option.value\">{{ option.text }}</option>\n            </select>\n\n            <select v-else class=\"uk-form-width-large\"\n                    v-bind=\"{name: fieldid, id: fieldid, size:field.data.size > 1 ? field.data.size : false}\"\n                    v-model=\"dataObject.value\"\n                    :required=\"fieldRequired\">\n                <option v-for=\"option in field.options\" :value=\"option.value\">{{ option.text }}</option>\n            </select>\n\n            <p class=\"uk-form-help-block uk-text-danger\" v-show=\"fieldInvalid(form)\">{{ field.data.requiredError ||\n                'Please select a value' | trans }}</p>\n        </div>\n    </div>";

/***/ }

/******/ });