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
/***/ function(module, exports, __webpack_require__) {

	module.exports = {

	    el: '#field-edit',

	    data: function () {
	        return _.merge({
	            field: {
	                data: {
	                    classSfx: '',
	                    required: false
	                }
	            },
	            form: {}
	        }, window.$data);
	    },

	    created: function () {
	        if (this.type.required !== -1) this.field.data.required = this.type.required;
	        if (this.type.multiple !== -1) this.field.data.multiple = this.type.multiple;
	    },

	    ready: function () {
	        this.Fields = this.$resource('api/userprofile/field/:id');
	        this.tab = UIkit.tab(this.$els.tab, {connect: this.$els.content});
	    },

	    methods: {

	        save: function () {

	            var data = {field: this.field};

	            this.$broadcast('save', data);

	            this.Fields.save({id: this.field.id}, data, function (data) {

	                if (!this.field.id) {
	                    window.history.replaceState({}, '', this.$url.route('admin/userprofile/edit', {id: data.field.id}))
	                }

	                this.$set('field', data.field);

	                this.$notify(this.$trans('%type% saved.', {type: this.type.label}));

	            }, function (data) {
	                this.$notify(data, 'danger');
	            });
	        }

	    },

	    components: {

	        fieldbasic: __webpack_require__(7),
	        fieldoptions: __webpack_require__(10),
	        appearance: __webpack_require__(13)

	    }

	};

	Vue.ready(module.exports);


/***/ },
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */,
/* 5 */,
/* 6 */,
/* 7 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(8)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(9)
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\app\\components\\field-basic.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
	  }
	})()}

/***/ },
/* 8 */
/***/ function(module, exports) {

	'use strict';

	// <template>

	//     <div class="uk-form-horizontal uk-margin">

	//         <div class="uk-form-row">

	//             <label for="form-label" class="uk-form-label">{{ 'Label' | trans }}</label>

	//             <div class="uk-form-controls">

	//                 <input id="form-label" class="uk-form-width-large" type="text" name="label"

	//                        v-model="field.label" v-valid="required">

	//             </div>

	//             <p class="uk-form-help-block uk-text-danger" v-show="form.label.invalid">{{ 'Please enter a label' | trans }}</p>

	//         </div>

	//         <div v-if="type.required < 0" class="uk-form-row">

	//             <span class="uk-form-label">{{ 'Field required' | trans }}</span>

	//             <div class="uk-form-controls uk-form-controls-text">

	//                 <label><input type="checkbox" value="required" v-model="field.data.required"> {{ 'Required' | trans

	//                     }}</label>

	//             </div>

	//         </div>

	//         <div v-if="type.multiple < 0" class="uk-form-row">

	//             <span class="uk-form-label">{{ 'Multiple values' | trans }}</span>

	//             <div class="uk-form-controls uk-form-controls-text">

	//                 <label><input type="checkbox" value="multiple" v-model="field.data.multiple"> {{ 'Multiple' | trans

	//                     }}</label>

	//             </div>

	//         </div>

	//         <div class="uk-form-row">

	//             <span class="uk-form-label">{{ 'Restrict Access' | trans }}</span>

	//             <div class="uk-form-controls uk-form-controls-text">

	//                 <p v-for="role in roles" class="uk-form-controls-condensed">

	//                     <label><input type="checkbox" :value="role.id" v-model="field.roles" number> {{ role.name }}</label>

	//                 </p>

	//             </div>

	//         </div>

	//         <input type="hidden" v-model="field.priority"/>

	//     </div>

	// </template>

	// <script>

	module.exports = {

	    props: ['field', 'type', 'form', 'roles']

	};

	// </script>

/***/ },
/* 9 */
/***/ function(module, exports) {

	module.exports = "<div class=\"uk-form-horizontal uk-margin\">\r\n\r\n        <div class=\"uk-form-row\">\r\n            <label for=\"form-label\" class=\"uk-form-label\">{{ 'Label' | trans }}</label>\r\n\r\n            <div class=\"uk-form-controls\">\r\n                <input id=\"form-label\" class=\"uk-form-width-large\" type=\"text\" name=\"label\"\r\n                       v-model=\"field.label\" v-valid=\"required\">\r\n            </div>\r\n            <p class=\"uk-form-help-block uk-text-danger\" v-show=\"form.label.invalid\">{{ 'Please enter a label' | trans }}</p>\r\n        </div>\r\n\r\n        <div v-if=\"type.required < 0\" class=\"uk-form-row\">\r\n            <span class=\"uk-form-label\">{{ 'Field required' | trans }}</span>\r\n\r\n            <div class=\"uk-form-controls uk-form-controls-text\">\r\n                <label><input type=\"checkbox\" value=\"required\" v-model=\"field.data.required\"> {{ 'Required' | trans\r\n                    }}</label>\r\n            </div>\r\n        </div>\r\n\r\n        <div v-if=\"type.multiple < 0\" class=\"uk-form-row\">\r\n            <span class=\"uk-form-label\">{{ 'Multiple values' | trans }}</span>\r\n\r\n            <div class=\"uk-form-controls uk-form-controls-text\">\r\n                <label><input type=\"checkbox\" value=\"multiple\" v-model=\"field.data.multiple\"> {{ 'Multiple' | trans\r\n                    }}</label>\r\n            </div>\r\n        </div>\r\n\r\n        <div class=\"uk-form-row\">\r\n            <span class=\"uk-form-label\">{{ 'Restrict Access' | trans }}</span>\r\n\r\n            <div class=\"uk-form-controls uk-form-controls-text\">\r\n                <p v-for=\"role in roles\" class=\"uk-form-controls-condensed\">\r\n                    <label><input type=\"checkbox\" :value=\"role.id\" v-model=\"field.roles\" number> {{ role.name }}</label>\r\n                </p>\r\n            </div>\r\n        </div>\r\n\r\n        <input type=\"hidden\" v-model=\"field.priority\"/>\r\n    </div>";

/***/ },
/* 10 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(11)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(12)
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\app\\components\\field-options.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
	  }
	})()}

/***/ },
/* 11 */
/***/ function(module, exports) {

	'use strict';

	// <template>

	//     <div class="uk-form-horizontal">

	//         <div class="uk-form-row">

	//             <span class="uk-form-label">{{ 'Manage options' | trans }}</span>

	//             <div class="uk-form-controls uk-form-controls-text">

	//                 <ul class="uk-nestable uk-margin-remove" v-el:options-nestable v-show="field.options.length">

	//                     <selectoption v-for="selectoption in field.options" :selectoption="selectoption"></selectoption>

	//                 </ul>

	//                 <button type="button" class="uk-button uk-button-primary uk-button-small uk-margin"

	//                         @click="addFieldoption">{{ 'Add option' | trans }}

	//                 </button>

	//             </div>

	//         </div>

	//     </div>

	// </template>

	// <script>

	module.exports = {

	    props: ['field', 'form'],

	    methods: {
	        addFieldoption: function addFieldoption() {
	            this.field.options.push({
	                value: '',
	                text: '',
	                attachValue: true,
	                invalid: false
	            });
	            this.$nextTick(function () {
	                $(this.$els.optionsNestable).find('input:last').focus();
	            });
	        },
	        deleteFieldoption: function deleteFieldoption(option) {
	            this.field.options.$remove(option);
	            this.checkDuplicates();
	            //todo nestable throws error Uncaught TypeError: a.getAttribute is not a function
	        },
	        checkDuplicates: function checkDuplicates() {
	            var current,
	                dups = [];
	            _.sortBy(this.field.options, 'value').forEach(function (option) {
	                if (current && current === option.value) {
	                    dups.push(option.value);
	                }
	                current = option.value;
	            });
	            this.field.options.forEach(function (option) {
	                option.invalid = dups.indexOf(option.value) > -1 ? 'Duplicate value' : false;
	            });
	        }
	    },

	    ready: function ready() {
	        var vm = this;
	        UIkit.nestable(this.$els.optionsNestable, {
	            maxDepth: 1,
	            handleClass: 'uk-nestable-handle',
	            group: 'userprofile.selectoptions'
	        }).on('change.uk.nestable', function (e, nestable, el, type) {
	            if (type && type !== 'removed') {

	                var options = [];
	                _.forEach(nestable.list(), function (option) {
	                    //todo can't reorder options with empty value
	                    options.push(_.find(vm.field.options, 'value', option.value));
	                });

	                vm.$set('field.options', options);
	            }
	        });
	    },

	    components: {

	        selectoption: {

	            props: ['selectoption', 'index'],

	            template: '<li class="uk-nestable-item" data-value="{{ selectoption.value }}">\n    <div class="uk-nestable-panel uk-visible-hover uk-form uk-flex uk-flex-middle">\n        <div class="uk-flex-item-1">\n            <div class="uk-form-row">\n                <small class="uk-form-label uk-text-muted uk-text-truncate" style="text-transform: none"\n                       v-show="selectoption.attachValue"\n                       :class="{\'uk-text-danger\': selectoption.invalid}">{{ selectoption.value }}</small>\n                <span class="uk-form-label" v-show="!selectoption.attachValue">\n                    <input type="text" class="uk-form-small"\n                           @keyup="safeValue(true)"\n                           :class="{\'uk-text-danger\': selectoption.invalid}"\n                           v-model="selectoption.value"/></span>\n                <div class="uk-form-controls">\n                    <input type="text" class="uk-form-width-large" v-model="selectoption.text"/></div>\n                <p class="uk-form-help-block uk-text-danger" v-show="selectoption.invalid">{{ selectoption.invalid | trans }}</p>\n\n            </div>\n        </div>\n        <div class="">\n            <ul class="uk-subnav pk-subnav-icon">\n                <li><a class="uk-icon uk-margin-small-top pk-icon-hover uk-invisible"\n                       data-uk-tooltip="{delay: 500}" title="{{ \'Link/Unlink value from label\' | trans }}"\n                       :class="{\'uk-icon-link\': !selectoption.attachValue, \'uk-icon-chain-broken\': selectoption.attachValue}"\n                       @click="selectoption.attachValue = !selectoption.attachValue"></a></li>\n                <li><a class="pk-icon-delete pk-icon-hover uk-invisible" @click="$parent.deleteFieldoption(selectoption)"></a></li>\n                <li><a class="pk-icon-move pk-icon-hover uk-invisible uk-nestable-handle"></a></li>\n            </ul>\n        </div>\n    </div>\n</li>   \n',

	            methods: {
	                safeValue: function safeValue(checkDups) {
	                    this.selectoption.value = _.escape(_.snakeCase(this.selectoption.value));
	                    if (checkDups) {
	                        this.$parent.checkDuplicates();
	                    }
	                }
	            },

	            watch: {
	                "selectoption.text": function selectoptionText(value) {
	                    if (this.selectoption.attachValue) {
	                        this.selectoption.value = _.escape(_.snakeCase(value));
	                    }
	                    this.$parent.checkDuplicates();
	                }

	            }
	        }

	    }
	};

	// </script>

/***/ },
/* 12 */
/***/ function(module, exports) {

	module.exports = "<div class=\"uk-form-horizontal\">\r\n\r\n        <div class=\"uk-form-row\">\r\n            <span class=\"uk-form-label\">{{ 'Manage options' | trans }}</span>\r\n\r\n            <div class=\"uk-form-controls uk-form-controls-text\">\r\n                <ul class=\"uk-nestable uk-margin-remove\" v-el:options-nestable v-show=\"field.options.length\">\r\n                    <selectoption v-for=\"selectoption in field.options\" :selectoption=\"selectoption\"></selectoption>\r\n                </ul>\r\n                <button type=\"button\" class=\"uk-button uk-button-primary uk-button-small uk-margin\"\r\n                        @click=\"addFieldoption\">{{ 'Add option' | trans }}\r\n                </button>\r\n            </div>\r\n        </div>\r\n\r\n    </div>";

/***/ },
/* 13 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(14)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(15)
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\userprofile\\app\\components\\appearance.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, (typeof module.exports === "function" ? module.exports.options : module.exports).template)
	  }
	})()}

/***/ },
/* 14 */
/***/ function(module, exports) {

	'use strict';

	// <template>

	//     <div class="uk-form-horizontal">

	//         <div class="uk-form-row">

	//             <span class="uk-form-label">{{ 'Label' | trans }}</span>

	//             <div class="uk-form-controls uk-form-controls-text">

	//                 <label><input type="checkbox" value="hide-label" v-model="field.data.hide_label"> {{ 'Hide Label' |

	//                     trans }}</label>

	//             </div>

	//         </div>

	//         <div class="uk-form-row">

	//             <label for="form-class" class="uk-form-label">{{ 'Class suffix' | trans }}</label>

	//             <div class="uk-form-controls">

	//                 <input id="form-class" class="uk-form-width-large" type="text" v-model="field.data.classSfx">

	//             </div>

	//         </div>

	//         <div class="uk-form-row" v-show="field.data.required">

	//             <label for="form-required-error" class="uk-form-label">{{ 'Required error message' | trans }}</label>

	//             <div class="uk-form-controls">

	//                 <input id="form-required-error" class="uk-form-width-large" type="text"

	//                        v-model="field.data.requiredError">

	//             </div>

	//         </div>

	//     </div>

	// </template>

	// <script>

	module.exports = {

	    props: ['field']

	};

	// </script>

/***/ },
/* 15 */
/***/ function(module, exports) {

	module.exports = "<div class=\"uk-form-horizontal\">\r\n\r\n        <div class=\"uk-form-row\">\r\n            <span class=\"uk-form-label\">{{ 'Label' | trans }}</span>\r\n\r\n            <div class=\"uk-form-controls uk-form-controls-text\">\r\n                <label><input type=\"checkbox\" value=\"hide-label\" v-model=\"field.data.hide_label\"> {{ 'Hide Label' |\r\n                    trans }}</label>\r\n            </div>\r\n        </div>\r\n\r\n        <div class=\"uk-form-row\">\r\n            <label for=\"form-class\" class=\"uk-form-label\">{{ 'Class suffix' | trans }}</label>\r\n\r\n            <div class=\"uk-form-controls\">\r\n                <input id=\"form-class\" class=\"uk-form-width-large\" type=\"text\" v-model=\"field.data.classSfx\">\r\n            </div>\r\n        </div>\r\n\r\n        <div class=\"uk-form-row\" v-show=\"field.data.required\">\r\n            <label for=\"form-required-error\" class=\"uk-form-label\">{{ 'Required error message' | trans }}</label>\r\n\r\n            <div class=\"uk-form-controls\">\r\n                <input id=\"form-required-error\" class=\"uk-form-width-large\" type=\"text\"\r\n                       v-model=\"field.data.requiredError\">\r\n            </div>\r\n        </div>\r\n\r\n    </div>";

/***/ }
/******/ ]);