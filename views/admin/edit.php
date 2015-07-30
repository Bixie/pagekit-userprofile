<?php  $view->script('field-edit', 'userprofile:app/bundle/field-edit.js', ['vue', 'uikit-nestable']); ?>

<form id="field-edit" class="uk-form" name="form" v-on="submit: save" v-cloak>

	<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
		<div data-uk-margin>

			<h2 class="uk-margin-remove" v-if="field.id">{{ 'Edit %type%' | trans {type:type.label} }}</h2>
			<h2 class="uk-margin-remove" v-if="!field.id">{{ 'Add %type%' | trans {type:type.label} }}</h2>

		</div>
		<div data-uk-margin>

			<a class="uk-button uk-margin-small-right" v-attr="href: $url('admin/userprofile')">{{ field.id ? 'Close' : 'Cancel' | trans }}</a>
			<button class="uk-button uk-button-primary" type="submit">{{ 'Save' | trans }}</button>

		</div>
	</div>

	<ul class="uk-tab" v-el="tab">
		<li ><a>{{ type.label | trans }}</a></li>
		<li ><a>{{ 'Appearance' | trans }}</a></li>
	</ul>

	<div class="uk-switcher uk-margin" v-el="content">
		<div>
			<fieldbasic field="{{@ field }}"></fieldbasic>
			<fieldoptions v-show="hasOptions" field="{{@ field }}"></fieldoptions>
		</div>
		<div>
			<appearance field="{{@ field }}"></appearance>
		</div>
	</div>

</form>
