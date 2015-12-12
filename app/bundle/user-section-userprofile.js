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

	module.exports = __webpack_require__(22)

	if (module.exports.__esModule) module.exports = module.exports.default
	;(typeof module.exports === "function" ? module.exports.options : module.exports).template = __webpack_require__(23)
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

/***/ 22:
/***/ function(module, exports) {

	'use strict';

	// <template>

	//     <div>

	//         <profilefields :fields.sync="fields" :profilevalues="profilevalues" :user="user" :form="form"></profilefields>

	//         <p v-show="!fields" class="uk-text-center"><i class="uk-icon-spinner uk-icon-spin"></i></p>

	//     </div>

	// </template>

	// <script>

	module.exports = {

	    props: ['user', 'config', 'form'],

	    data: function data() {
	        return {
	            fields: [],
	            profilevalues: []
	        };
	    },

	    section: {
	        label: 'Userprofile',
	        priority: 200
	    },

	    created: function created() {
	        this.Fields = this.$resource('api/userprofile/profile/:id');
	        this.load();
	        this.$on('save', function (data) {
	            data.profilevalues = this.profilevalues;
	        });
	    },

	    methods: {

	        load: function load() {
	            return this.Fields.query({ id: this.user.id }, function (data) {
	                this.$set('fields', data.fields);
	                this.$set('profilevalues', data.profilevalues);
	            }, function (message) {
	                this.$notify('Userprofile: ' + message, 'danger');
	            });
	        }
	    }

	};

	window.User.components['user-section-userprofile:profile'] = module.exports;

	// </script>

/***/ },

/***/ 23:
/***/ function(module, exports) {

	module.exports = "<div>\r\n\r\n        <profilefields :fields.sync=\"fields\" :profilevalues=\"profilevalues\" :user=\"user\" :form=\"form\"></profilefields>\r\n\r\n        <p v-show=\"!fields\" class=\"uk-text-center\"><i class=\"uk-icon-spinner uk-icon-spin\"></i></p>\r\n\r\n    </div>";

/***/ }

/******/ });