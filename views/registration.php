<?php $view->script('userprofile-registration', 'bixie/userprofile:app/bundle/registration.js', ['bixie-fieldtypes', 'uikit-form-password']) ?>

<form id="userprofile-registration" class="uk-article uk-form uk-form-stacked" name="form" v-validator="form" @submit.prevent="save | valid" v-cloak>
	<div class="uk-grid">
		<div class="uk-width-medium-3-4">
			<h1 class="uk-article-title">{{ 'Registration' | trans }}</h1>

			<div class="uk-alert uk-alert-danger" v-show="error">{{ error }}</div>

			<div class="uk-form-row">
				<label for="form-username" class="uk-form-label">{{ 'Username' | trans }}</label>

				<div class="uk-form-controls">
					<input id="form-username" class="uk-form-width-large" type="text" name="username"
						   v-model="user.username" v-validate:required>

					<p class="uk-form-help-block uk-text-danger"
					   v-show="form.username.invalid">{{ 'Username cannot be blank.' | trans }}</p>
				</div>
			</div>

			<div class="uk-form-row">
				<label for="form-name" class="uk-form-label">{{ 'Name' | trans }}</label>

				<div class="uk-form-controls">
					<input id="form-name" class="uk-form-width-large" type="text" name="name"
						   v-model="user.name" v-validate:required>

					<p class="uk-form-help-block uk-text-danger"
					   v-show="form.name.invalid">{{ 'Name cannot be blank.' | trans }}</p>
				</div>
			</div>

			<div class="uk-form-row">
				<label for="form-email" class="uk-form-label">{{ 'Email' | trans }}</label>

				<div class="uk-form-controls">
					<input id="form-email" class="uk-form-width-large" type="text" name="email"
						   v-model="user.email"  v-validate:required  v-validate:email>

					<p class="uk-form-help-block uk-text-danger" v-show="form.email.invalid">{{ 'Invalid Email.' | trans
						}}</p>
				</div>
			</div>

			<div class="uk-form-row js-password">
				<label for="form-password" class="uk-form-label">{{ 'Password' | trans }}</label>

				<div class="uk-form-controls">
					<div class="uk-form-password">
						<input id="form-password" class="uk-form-width-large" type="password" name="password"
							   v-model="user.password" v-validate:required>
						<a href="" class="uk-form-password-toggle" tabindex="-1"
						   data-uk-form-password="{ lblShow: '{{ 'Show' | trans }}', lblHide: '{{ 'Hide' | trans }}' }">{{
							'Show' | trans }}</a>
					</div>
					<p class="uk-form-help-block uk-text-danger" v-show="form.password.invalid">{{ 'Password cannot be
						blank.' | trans }}</p>
				</div>
			</div>

			<fieldtypes class="uk-margin" :fields="fields"
						:model.sync="profilevalues"
						:user="user"
						:form="form"></fieldtypes>

			<div class="uk-form-row">
				<button class="uk-button uk-button-primary" type="submit">{{ 'Register' | trans }}</button>
			</div>

		</div>
		<div class="uk-width-medium-1-4">

			<div class="uk-panel uk-panel-box uk-text-center" v-show="user.username">

				<div class="uk-panel-teaser">
					<img height="280" width="280" :alt="user.username" v-gravatar="user.email">
				</div>

				<h3 class="uk-panel-title uk-margin-bottom-remove">{{ user.username }}</h3>

			</div>

		</div>
	</div>

</form>
