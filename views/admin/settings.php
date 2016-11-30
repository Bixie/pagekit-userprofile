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

    <div class="uk-grid pk-grid-large" data-uk-grid-margin>
        <div class="pk-width-sidebar">

            <div class="uk-panel">

                <ul class="uk-nav uk-nav-side pk-nav-large" data-uk-tab="{ connect: '#tab-content' }">
                    <li><a><i class="pk-icon-large-settings uk-margin-right"></i> {{ 'List page settings' | trans }}</a></li>
                    <li><a><i class="pk-icon-large-settings uk-margin-right"></i> {{ 'Details page settings' | trans }}</a></li>
                    <li><a><i class="pk-icon-large-settings uk-margin-right"></i> {{ 'General settings' | trans }}</a></li>
                </ul>

            </div>

        </div>
        <div class="pk-width-content">

            <ul id="tab-content" class="uk-switcher uk-margin">
                <li class="uk-form-horizontal">
                    <div class="uk-grid uk-grid-width-medium-1-2" data-uk-grid-margin>
                        <div>

                            <h3>{{ 'List display options' | trans }}</h3>

                            <bixie-fields :config="$options.fields.list" :values.sync="config.list"></bixie-fields>
                        </div>
                        <div>

                            <h3>{{ 'Show in list page' | trans }}</h3>

                            <input-multiselect :value.sync="config.list.show_fields"
                                               :options="fieldOptions"></input-multiselect>

                        </div>
                    </div>

                </li>
                <li class="uk-form-horizontal">
                    <div class="uk-grid uk-grid-width-medium-1-2" data-uk-grid-margin>
                        <div>

                            <h3>{{ 'Details display options' | trans }}</h3>

                            <bixie-fields :config="$options.fields.details" :values.sync="config.details"></bixie-fields>

                        </div>
                        <div>
                            <h3>{{ 'Show in details page' | trans }}</h3>

                            <input-multiselect :value.sync="config.details.show_fields"
                                               :options="fieldOptions"></input-multiselect>

                        </div>
                    </div>

                </li>
                <li class="uk-form-horizontal">
                    <h3>{{ 'General' | trans }}</h3>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Profile avatar' | trans }}</label>
                        <div class="uk-form-controls">
                            <select v-if="uploadFields.length" v-model="config.avatar_field" class="uk-form-width-medium">
                                <option value="">{{ 'Use Pagekit default' | trans }}</option>
                                <option v-for="field in uploadFields" :value="field.slug">{{ field.label }}</option>
                            </select>
                            <p v-else class="uk-form-controls-condensed">
                                <em>{{ 'Create an upload field in the profile!' | trans }}</em>
                            </p>
                        </div>
                    </div>

                    <div v-if="config.avatar_field" class="uk-form-row">
                        <label class="uk-form-label">{{ 'Gravatar' | trans }}</label>
                        <div class="uk-form-controls">
                            <label>
                                <input type="checkbox" v-model="config.use_gravatar" class="uk-margin-small-right"/>
                                {{ 'Use Gravatar/letter image as fallback' | trans }}
                            </label>
                        </div>
                    </div>

                    <div v-if="config.avatar_field && !config.use_gravatar" class="uk-form-row">
                        <label class="uk-form-label">{{ 'Fallback image' | trans }}</label>
                        <div class="uk-form-controls">
                            <input-image :source.sync="config.fallback_image_src" class="pk-image-max-height"></input-image>
                        </div>
                    </div>

                    <bixie-fields :config="$options.fields.general" :values.sync="config"></bixie-fields>

                </li>
            </ul>

        </div>
    </div>

</div>
