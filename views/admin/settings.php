<?php
$view->script('userprofile-settings', 'bixie/userprofile:app/bundle/userprofile-settings.js', ['bixie-pkframework']) ?>

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

				<bixie-fields :config="$options.fields.general" :values.sync="config"></bixie-fields>

				<h3>{{ 'List display options' | trans }}</h3>

				<bixie-fields :config="$options.fields.list" :values.sync="config.list"></bixie-fields>

		    </div>
		    <div>

				<h3>{{ 'Details display options' | trans }}</h3>

				<bixie-fields :config="$options.fields.details" :values.sync="config.details"></bixie-fields>

		    </div>
		</div>


	</div>



</div>
