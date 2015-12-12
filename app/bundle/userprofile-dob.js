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

	module.exports = __webpack_require__(8)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(9)
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\fieldtypes\\dob\\dob.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
	  }
	})()}

/***/ },

/***/ 8:
/***/ function(module, exports) {

	'use strict';

	// <template>

	//     <div v-if="isAdmin" class="uk-form-row {{field.data.classSfx}}">
	//         <span for="form-date-format" class="uk-form-label">{{ 'Date format' | trans }}</span>

	//         <div class="uk-form-controls">
	//             <select class="uk-form-width-medium" id="form-date-format" v-model="field.data.dateFormat">
	//                 <option v-for="option in dateFormats" :value="option.value">{{ option.text }}</option>
	//             </select>
	//         </div>
	//     </div>

	//     <div v-if="isAdmin" class="uk-form-row {{field.data.classSfx}}">
	//         <span for="form-min-age" class="uk-form-label">{{ 'Minimum age' | trans }}</span>

	//         <div class="uk-form-controls">
	//             <select class="uk-form-width-small" id="form-min-age" options="numbersList(1,120)" v-model="field.data.minAge">
	//                 <option v-for="option in numbersList(1,120)" :value="option.value">{{ option.text }}</option>
	//             </select>
	//         </div>
	//     </div>

	//     <div v-if="isAdmin" class="uk-form-row {{field.data.classSfx}}">
	//         <span for="form-max-age" class="uk-form-label">{{ 'Maximum age' | trans }}</span>

	//         <div class="uk-form-controls">
	//             <select class="uk-form-width-small" id="form-max-age" v-model="field.data.maxAge">
	//                 <option v-for="option in numbersList(1,120)" :value="option.value">{{ option.text }}</option>
	//             </select>
	//         </div>
	//     </div>

	//     <div v-if="!isAdmin" v-el:dob class="uk-form-row {{field.data.classSfx}}">
	//     <span class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans
	//         }}</span>

	//         <div class="uk-form-controls uk-flex">
	//             <div class="uk-grid uk-grid-small uk-grid-width-1-3 uk-width-1-1">

	//                 <div>
	//                     <div class="uk-button uk-width-1-1 uk-form-select" data-uk-form-select><span></span>
	//                         <i class="uk-icon-caret-down uk-margin-left"></i>
	//                         <select class="" v-model="month">
	//                             <option v-for="option in months" :value="option.value">{{ option.text }}</option>
	//                         </select>
	//                     </div>
	//                 </div>

	//                 <div :class="{'uk-flex-order-first': field.data.dateFormat == 'DD-MM-YYYY'}">
	//                     <div class="uk-button uk-width-1-1 uk-form-select" data-uk-form-select><span></span>
	//                         <i class="uk-icon-caret-down uk-margin-left"></i>
	//                         <select class="" options="numbersList(1,31, 'Day')" v-model="day">
	//                             <option v-for="option in numbersList(1,31, 'Day')" :value="option.value">{{ option.text }}</option>
	//                         </select>
	//                     </div>
	//                 </div>

	//                 <div>
	//                     <div class="uk-button uk-width-1-1 uk-form-select" data-uk-form-select><span></span>
	//                         <i class="uk-icon-caret-down uk-margin-left"></i>
	//                         <select class="" options="years" v-model="year">
	//                             <option v-for="option in years" :value="option.value">{{ option.text }}</option>
	//                         </select>
	//                     </div>
	//                 </div>

	//             </div>
	//         </div>
	//     </div>

	// </template>

	// <script>

	module.exports = {

	    inherit: true,

	    mixins: [ProfilefieldMixin],

	    data: function data() {
	        return {
	            dataObject: {},
	            fieldid: _.uniqueId('profilefield_'),
	            dobDate: false,
	            day: '',
	            month: '',
	            year: '',
	            dateFormats: ['MM-DD-YYYY', 'DD-MM-YYYY']
	        };
	    },

	    created: function created() {
	        this.$set('dataObject', this.getDataObject(this.field.data.value || ''));
	        //value dob
	        if (this.dataObject.value) {
	            this.setDate(this.dataObject.value);
	        } else {
	            this.dobDate = UIkit.Utils.moment();
	        }
	        //defaults admin
	        this.field.data.minAge = this.field.data.minAge || 1;
	        this.field.data.maxAge = this.field.data.maxAge || 120;
	        this.field.data.dateFormat = this.field.data.dateFormat || 'MM-DD-YYYY';
	    },

	    ready: function ready() {
	        UIkit.init(this.$els.dob);
	    },

	    computed: {
	        months: function months() {
	            return [{ value: '', text: this.$trans('Month') }, { value: '0', text: this.$trans('January') }, { value: '1', text: this.$trans('February') }, { value: '2', text: this.$trans('March') }, { value: '3', text: this.$trans('April') }, { value: '4', text: this.$trans('May') }, { value: '5', text: this.$trans('June') }, { value: '6', text: this.$trans('July') }, { value: '7', text: this.$trans('August') }, { value: '8', text: this.$trans('September') }, { value: '9', text: this.$trans('October') }, { value: '10', text: this.$trans('November') }, { value: '11', text: this.$trans('December') }];
	        },
	        years: function years() {
	            var now = UIkit.Utils.moment();
	            return this.numbersList(now.year() - this.field.data.maxAge, now.year() - this.field.data.minAge, 'Year');
	        }
	    },

	    methods: {
	        setDate: function setDate(strDate) {
	            try {
	                this.dobDate = UIkit.Utils.moment(strDate);
	                this.day = this.dobDate.date();
	                this.month = this.dobDate.month();
	                this.year = this.dobDate.year();
	            } catch (e) {}
	        },
	        updateDate: function updateDate() {
	            if (this.day && this.month && this.year) {
	                this.dataObject.value = this.dobDate.format('YYYY-MM-DD');
	            } else {
	                this.dataObject.value = '';
	            }
	        },
	        numbersList: function numbersList(start, end, first) {
	            var nrs = first ? [{ value: "", text: this.$trans(first) }] : [];
	            for (var i = start; i <= end; i++) {
	                nrs.push({ value: i + "", text: i });
	            }return nrs;
	        }
	    },
	    watch: {
	        day: function day(value) {
	            if (value !== '') {
	                this.dobDate.date(parseInt(value, 10));
	            }
	            this.updateDate();
	        },
	        month: function month(value) {
	            if (value !== '') {
	                this.dobDate.month(parseInt(value, 10));
	            }
	            this.updateDate();
	        },
	        year: function year(value) {
	            if (value !== '') {
	                this.dobDate.year(parseInt(value, 10));
	            }
	            this.updateDate();
	        }
	    }

	};

	window.Profilefields.components['dob'] = module.exports;

	// </script>

/***/ },

/***/ 9:
/***/ function(module, exports) {

	module.exports = "<div v-if=\"isAdmin\" class=\"uk-form-row {{field.data.classSfx}}\">\n        <span for=\"form-date-format\" class=\"uk-form-label\">{{ 'Date format' | trans }}</span>\n\n        <div class=\"uk-form-controls\">\n            <select class=\"uk-form-width-medium\" id=\"form-date-format\" v-model=\"field.data.dateFormat\">\n                <option v-for=\"option in dateFormats\" :value=\"option.value\">{{ option.text }}</option>\n            </select>\n        </div>\n    </div>\n\n    <div v-if=\"isAdmin\" class=\"uk-form-row {{field.data.classSfx}}\">\n        <span for=\"form-min-age\" class=\"uk-form-label\">{{ 'Minimum age' | trans }}</span>\n\n        <div class=\"uk-form-controls\">\n            <select class=\"uk-form-width-small\" id=\"form-min-age\" options=\"numbersList(1,120)\" v-model=\"field.data.minAge\">\n                <option v-for=\"option in numbersList(1,120)\" :value=\"option.value\">{{ option.text }}</option>\n            </select>\n        </div>\n    </div>\n\n    <div v-if=\"isAdmin\" class=\"uk-form-row {{field.data.classSfx}}\">\n        <span for=\"form-max-age\" class=\"uk-form-label\">{{ 'Maximum age' | trans }}</span>\n\n        <div class=\"uk-form-controls\">\n            <select class=\"uk-form-width-small\" id=\"form-max-age\" v-model=\"field.data.maxAge\">\n                <option v-for=\"option in numbersList(1,120)\" :value=\"option.value\">{{ option.text }}</option>\n            </select>\n        </div>\n    </div>\n\n    <div v-if=\"!isAdmin\" v-el:dob class=\"uk-form-row {{field.data.classSfx}}\">\n    <span class=\"uk-form-label\" v-show=\"!field.data.hide_label\">{{ fieldLabel | trans\n        }}</span>\n\n        <div class=\"uk-form-controls uk-flex\">\n            <div class=\"uk-grid uk-grid-small uk-grid-width-1-3 uk-width-1-1\">\n\n                <div>\n                    <div class=\"uk-button uk-width-1-1 uk-form-select\" data-uk-form-select><span></span>\n                        <i class=\"uk-icon-caret-down uk-margin-left\"></i>\n                        <select class=\"\" v-model=\"month\">\n                            <option v-for=\"option in months\" :value=\"option.value\">{{ option.text }}</option>\n                        </select>\n                    </div>\n                </div>\n\n                <div :class=\"{'uk-flex-order-first': field.data.dateFormat == 'DD-MM-YYYY'}\">\n                    <div class=\"uk-button uk-width-1-1 uk-form-select\" data-uk-form-select><span></span>\n                        <i class=\"uk-icon-caret-down uk-margin-left\"></i>\n                        <select class=\"\" options=\"numbersList(1,31, 'Day')\" v-model=\"day\">\n                            <option v-for=\"option in numbersList(1,31, 'Day')\" :value=\"option.value\">{{ option.text }}</option>\n                        </select>\n                    </div>\n                </div>\n\n                <div>\n                    <div class=\"uk-button uk-width-1-1 uk-form-select\" data-uk-form-select><span></span>\n                        <i class=\"uk-icon-caret-down uk-margin-left\"></i>\n                        <select class=\"\" options=\"years\" v-model=\"year\">\n                            <option v-for=\"option in years\" :value=\"option.value\">{{ option.text }}</option>\n                        </select>\n                    </div>\n                </div>\n\n            </div>\n        </div>\n    </div>";

/***/ }

/******/ });