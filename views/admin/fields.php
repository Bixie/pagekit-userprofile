<?php $view->script('fields-userprofile', 'userprofile:app/bundle/fields.js', ['vue', 'uikit-nestable']) ?>

<div id="userprofile-fields" class="uk-form uk-form-horizontal" v-cloak>

	<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
		<div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>

			<h2 class="uk-margin-remove">{{ menu.label | trans }}</h2>

			<div class="uk-margin-left" v-show="selected.length">
				<ul class="uk-subnav pk-subnav-icon">
					<li><a class="pk-icon-delete pk-icon-hover" title="{{ 'Delete' | trans }}" data-uk-tooltip="{delay: 500}" v-on="click: removeFields"
						   v-confirm="'Delete field? All values will be deleted from the userprofiles.' | trans"></a></li>
				</ul>
			</div>

		</div>
		<div class="uk-position-relative" data-uk-margin>

			<div data-uk-dropdown="{ mode: 'click' }">
				<a class="uk-button uk-button-primary" v-on="click: $event.preventDefault()">{{ 'Add Field' | trans }}</a>
				<div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
					<ul class="uk-nav uk-nav-dropdown">
						<li v-repeat="type: types | orderBy 'label'"><a v-attr="href: $url('admin/userprofile/edit', { id: type.id })">{{ type.label }}</a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>

	<div class="uk-overflow-container">

		<div class="pk-table-fake pk-table-fake-header" v-class="pk-table-fake-border: !fields || !fields.length">
			<div class="pk-table-width-minimum pk-table-fake-nestable-padding"><input type="checkbox" v-check-all="selected: input[name=id]"></div>
			<div class="pk-table-min-width-100">{{ 'Label' | trans }}</div>
			<div class="pk-table-width-100 uk-text-center">{{ 'Required' | trans }}</div>
			<div class="pk-table-width-150">{{ 'Type' | trans }}</div>
		</div>

		<ul class="uk-nestable uk-margin-remove" v-el="nestable" v-show="fields.length">
			<field v-repeat="field: fields | orderBy 'priority'"></field>

		</ul>

	</div>

	<h3 class="uk-h1 uk-text-muted uk-text-center" v-show="fields && !fields.length">{{ 'No fields found.' | trans }}</h3>

</div>

<script id="field" type="text/template">
	<li class="uk-nestable-item" v-class="uk-active: isSelected(field)" data-id="{{ field.id }}">

		<div class="uk-nestable-panel pk-table-fake uk-form uk-visible-hover">
			<div class="pk-table-width-minimum pk-table-collapse">
				<div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
			</div>
			<div class="pk-table-width-minimum"><input type="checkbox" name="id" value="{{ field.id }}"></div>
			<div class="pk-table-min-width-100">
				<a v-attr="href: $url('admin/userprofile/edit', { id: field.id })">{{ field.label }}</a>
			</div>
			<div class="pk-table-width-100 uk-text-center">
				<td class="uk-text-center">
					<a v-class="pk-icon-circle-danger: !field.data.required, pk-icon-circle-success: field.data.required" v-on="click: toggleRequired(field)"></a>
				</td>
			</div>
			<div class="pk-table-width-150 pk-table-max-width-150 uk-text-truncate">
				{{ type.label }}
			</div>
		</div>


	</li>

</script>