<?php
$view->script('userprofile', 'bixie/userprofile:app/bundle/userprofile.js', ['bixie-fieldtypes', 'uikit-form-password']);
?>

<form id="userprofile-profile" class="uk-article uk-form uk-form-stacked"
	  name="form" v-validator="form" @submit.prevent="save | valid" v-cloak>

	<div class="uk-grid">
		<div class="uk-width-medium-3-4">
			<h1 class="uk-article-title">{{ 'Your Profile' | trans }}</h1>

			<div class="uk-alert uk-alert-success" v-if="message">{{ message }}</div>
			<div class="uk-alert uk-alert-danger" v-if="error">{{ error }}</div>

			<div class="uk-form-row">
				<label for="form-name" class="uk-form-label">{{ 'Name' | trans }}</label>

				<div class="uk-form-controls">
					<input id="form-name" class="uk-form-width-large" type="text" name="name" v-model="user.name"
						   v-validate:required>

					<p class="uk-form-help-block uk-text-danger"
					   v-show="form.name.invalid">{{ 'Name cannot be blank.' | trans }}</p>
				</div>
			</div>

			<div class="uk-form-row">
				<label for="form-email" class="uk-form-label">{{ 'Email' | trans }}</label>

				<div class="uk-form-controls">
					<input id="form-email" class="uk-form-width-large" type="text" name="email" v-model="user.email"
						   v-validate:email v-validate:required>

					<p class="uk-form-help-block uk-text-danger" v-show="form.email.invalid">{{ 'Invalid Email.' | trans
						}}</p>
				</div>
			</div>

			<div class="uk-form-row">
				<a href="#" data-uk-toggle="{ target: '.js-password' }">{{ 'Change password' | trans }}</a>
			</div>

			<div class="uk-form-row js-password uk-hidden">
				<label for="form-password-old" class="uk-form-label">{{ 'Current Password' | trans }}</label>

				<div class="uk-form-controls">
					<div class="uk-form-password">
						<input id="form-password-old" class="uk-form-width-large" type="password" value=""
							   v-model="user.password_old">
						<a href="" class="uk-form-password-toggle"
						   data-uk-form-password="{ lblShow: '{{ 'Show' | trans }}', lblHide: '{{ 'Hide' | trans }}' }">{{
							'Show' | trans }}</a>
					</div>
				</div>
			</div>

			<div class="uk-form-row js-password uk-hidden">
				<label for="form-password-new" class="uk-form-label">{{ 'New Password' | trans }}</label>

				<div class="uk-form-controls">
					<div class="uk-form-password">
						<input id="form-password-new" class="uk-form-width-large" type="password" value=""
							   v-model="user.password_new">
						<a href="" class="uk-form-password-toggle"
						   data-uk-form-password="{ lblShow: '{{ 'Show' | trans }}', lblHide: '{{ 'Hide' | trans }}' }">{{
							'Show' | trans }}</a>
					</div>
				</div>
			</div>

			<fieldtypes class="uk-margin" :fields="fields"
						:model.sync="profilevalues"
						:user="user"
						:form="form"></fieldtypes>

			<div class="uk-form-row">
				<button class="uk-button uk-button-primary" type="submit">{{ 'Save' | trans }}</button>
			</div>

		</div>
		<div class="uk-width-medium-1-4">

			<div class="uk-panel uk-panel-box uk-text-center" v-show="user.username">

				<div class="uk-panel-teaser">
					{{{ profile_user.avatar_image }}}
				</div>

				<h3 class="uk-panel-title uk-margin-bottom-remove">{{ user.username }}</h3>

			</div>

		</div>
	</div>

</form>
