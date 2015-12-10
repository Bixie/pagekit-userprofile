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
/***/ function(module, exports) {

	module.exports = {

	    el: '#userprofile-fields',

	    data: function () {
	        return _.merge({
	            users: false,
	            pages: 0,
	            count: '',
	            fields: [],
	            types: [],
	            selected: []
	        }, window.$data);
	    },

	    created: function () {
	        this.Fields = this.$resource('api/userprofile/field/:id');
	        this.load();
	    },

	    methods: {

	        load: function () {
	            return this.Fields.query(function (data) {
	                this.$set('fields', data);
	            });
	        },

	        toggleRequired: function (field) {

	            field.data.required = field.data.required ? 0 : 1;

	            this.Fields.save({id: field.id}, {field: field}, function () {
	                this.load();
	                this.$notify('Field saved.');
	            }, function (message) {
	                this.load();
	                this.$notify(message, 'danger');
	            });
	        },

	        getSelected: function () {
	            return this.fields.filter(function (field) {
	                return this.isSelected(field);
	            }, this);
	        },

	        isSelected: function (field, children) {

	            if (_.isArray(field)) {
	                return _.every(field, function (field) {
	                    return this.isSelected(field, children);
	                }, this);
	            }

	            return this.selected.indexOf(field.id.toString()) !== -1 && (!children || !this.tree[field.id] || this.isSelected(this.tree[field.id], true));
	        },

	        toggleSelect: function (field) {

	            var index = this.selected.indexOf(field.id.toString());

	            if (index == -1) {
	                this.selected.push(field.id.toString());
	            } else {
	                this.selected.splice(index, 1);
	            }
	        },

	        getType: function (field) {
	            return _.find(this.types, 'id', field.type);
	        },

	        removeFields: function () {

	            this.Fields.delete({id: 'bulk'}, {ids: this.selected}, function () {
	                this.load();
	                this.$notify('Fields(s) deleted.');
	            });
	        }

	    },

	    components: {

	        field: {

	            props: ['field'],
	            template: '#field',
	            computed: {
	                type: function () {
	                    return this.$root.getType(this.field);
	                }
	            },
	            methods: {
	                isSelected: function (field) {
	                    return this.$root.isSelected(field);
	                }
	            }
	        }

	    },

	    watch: {

	        fields: function () {

	            var vm = this;

	            // TODO this is still buggy
	            UIkit.nestable(this.$els.nestable, {
	                maxDepth: 1,
	                group: 'userprofile.fields'
	            }).off('change.uk.nestable').on('change.uk.nestable', function (e, nestable, el, type) {

	                if (type && type !== 'removed') {

	                    vm.Fields.save({id: 'updateOrder'}, {fields: nestable.list()}, function () {

	                        // @TODO reload everything on reorder really needed?
	                        vm.load().success(function () {

	                            // hack for weird flickr bug
	                            if (el.parent()[0] === nestable.element[0]) {
	                                setTimeout(function () {
	                                    el.remove();
	                                }, 50);
	                            }
	                        });

	                    }).error(function () {
	                        this.$notify('Reorder failed.', 'danger');
	                    });
	                }
	            });
	        }
	    }

	};


	Vue.ready(module.exports);



/***/ }
/******/ ]);