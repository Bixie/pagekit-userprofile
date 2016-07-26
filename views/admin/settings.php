<?php
$view->script('userprofile-settings', 'bixie/userprofile:app/bundle/userprofile-settings.js', ['bixie-framework']) ?>

<div id="userprofile-settings" class="uk-form">

	<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
		<div data-uk-margin>

			<h2 class="uk-margin-remove">{{ 'Userprofile settings' | trans }}</h2>

		</div>
		<div data-uk-margin>

			<button class="uk-button uk-button-primary" @click="save">{{ 'Save' | trans }}</button>

		</div>
	</div>

	<div class="uk-form-horizontal">
		<div class="uk-grid uk-grid-width-medium-1-2" data-uk-grid-margin>
		    <div>

				<h3>{{ 'General' | trans }}</h3>

				<fields :config="$options.fields.general" :model.sync="config" template="formrow"></fields>

				<h3>{{ 'List display options' | trans }}</h3>

				<fields :config="$options.fields.list" :model.sync="config.list" template="formrow"></fields>

		    </div>
		    <div>

				<h3>{{ 'Details display options' | trans }}</h3>

				<fields :config="$options.fields.details" :model.sync="config.details" template="formrow"></fields>

		    </div>
		</div>


	</div>



</div>
