<?php $view->script('field-edit', 'bixie/userprofile:app/bundle/field-edit.js', ['vue', 'userprofile-profilefields', 'uikit-nestable']); ?>

<form id="field-edit" class="uk-form" v-validator="form" @submit.prevent="save | valid" v-cloak>

	<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
		<div data-uk-margin>

			<h2 class="uk-margin-remove" v-if="field.id">{{ 'Edit %type%' | trans {type:type.label} }} <em>{{
					field.label | trans }}</em></h2>
			<h2 class="uk-margin-remove" v-else>{{ 'Add %type%' | trans {type:type.label} }}</h2>

		</div>
		<div data-uk-margin>

			<a class="uk-button uk-margin-small-right" :href="$url.route('admin/userprofile')">
				{{ field.id ? 'Close' : 'Cancel' | trans }}</a>
			<button class="uk-button uk-button-primary" type="submit">{{ 'Save' | trans }}</button>

		</div>
	</div>

	<ul class="uk-tab" v-el:tab>
		<li><a>{{ type.label | trans }}</a></li>
		<li v-show="type.hasOptions"><a>{{ 'Options' | trans }}</a></li>
		<li><a>{{ 'Appearance' | trans }}</a></li>
	</ul>

	<div class="uk-switcher uk-margin" v-el:content>
		<div>
			<fieldbasic :field.sync="field" :type="type" :form="form" :roles="roles"></fieldbasic>

			<div class="uk-form-horizontal uk-margin">
				<div class="uk-margin" v-if="fieldSettings">
					<fields :config="fieldSettings" :model.sync="field.data" template="formrow"></fields>
				</div>

				<profilefields class="uk-margin" v-show="!type.hasOptions || field.options.length"
							   v-ref:formmakerfields
							   :edit-type="field.type"
							   :field.sync="field"
							   :fields="[field]"
							   :profilevalues="profilevalues"
							   :user="user"
							   :form="form"></profilefields>

				<div id="type-settings" class="uk-margin"
					 :data-object.sync="field.data"
					 :field.sync="field"
					 :form="form"></div>

			</div>
		</div>
		<div>
			<fieldoptions v-show="type.hasOptions" :field.sync="field" :form="form"></fieldoptions>
		</div>
		<div>
			<appearance :field.sync="field" :form="form"></appearance>
		</div>
	</div>

</form>
