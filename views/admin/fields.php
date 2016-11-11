<?php $view->script('fields-userprofile', 'bixie/userprofile:app/bundle/fields.js', ['bixie-pkframework', 'uikit-nestable']) ?>

<?php if ($frameworkValid !== true) : ?>
	<div class="uk-alert uk-alert-warning">
		<p><?=$frameworkValid?></p>
		<p><a href="<?=$view->url('admin/system/marketplace/extensions')?>">
				<?=__('Download and install the Bixie Framework via the Pagekit Marketplace.')?>
			</a></p>
	</div>
<?php endif; ?>

<div id="userprofile-fields" class="uk-form uk-form-horizontal" v-cloak>

	<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
		<div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>

			<h2 class="uk-margin-remove">{{ 'Fields' | trans }}</h2>

			<div class="uk-margin-left" v-show="selected.length">
				<ul class="uk-subnav pk-subnav-icon">
					<li><a class="pk-icon-delete pk-icon-hover" title="{{ 'Delete' | trans }}"
						   data-uk-tooltip="{delay: 500}" @click.prevent="removeFields"
						   v-confirm="'Delete field? All values will be deleted from the userprofiles.' | trans"></a>
					</li>
				</ul>
			</div>

		</div>
		<div class="uk-position-relative" data-uk-margin>

			<div data-uk-dropdown="{ mode: 'click' }">
				<a class="uk-button uk-button-primary" @click.prevent="">{{ 'Add Field' | trans
					}}</a>

				<div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
					<ul class="uk-nav uk-nav-dropdown">
						<li v-for="type in types | orderBy 'label'"><a
								:href="$url.route('admin/userprofile/edit', { id: type.id })">{{ type.label }}</a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>

	<div class="uk-overflow-container">

		<div class="pk-table-fake pk-table-fake-header" :class="{'pk-table-fake-border': (!fields || !fields.length)}">
			<div class="pk-table-width-minimum pk-table-fake-nestable-padding"><input type="checkbox"
																					  v-check-all:selected.literal="input[name=id]">
			</div>
			<div class="pk-table-min-width-100">{{ 'Label' | trans }}</div>
			<div class="pk-table-width-100 uk-text-center">{{ 'Required' | trans }}</div>
			<div class="pk-table-width-150">{{ 'Type' | trans }}</div>
		</div>

		<ul class="uk-nestable uk-margin-remove" v-el:nestable v-show="fields.length">
			<field v-for="field in fields | orderBy 'priority'" :field="field"></field>

		</ul>

	</div>

	<h3 class="uk-h1 uk-text-muted uk-text-center" v-show="fields && !fields.length">
		{{ 'No fields found.' | trans }}</h3>

</div>

<script id="field" type="text/template">
	<li class="uk-nestable-item" :class="{'uk-active': $parent.isSelected(field)}" data-id="{{ field.id }}">

		<div class="uk-nestable-panel pk-table-fake uk-form uk-visible-hover">
			<div class="pk-table-width-minimum pk-table-collapse">
				<div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
			</div>
			<div class="pk-table-width-minimum"><input type="checkbox" name="id" :value="field.id"></div>
			<div class="pk-table-min-width-100">
				<a :href="$url.route('admin/userprofile/edit', { id: field.id })">{{ field.label }}</a>
			</div>
			<div class="pk-table-width-100 uk-text-center">
				<td class="uk-text-center">
					<a :class="{'pk-icon-circle-danger': !field.data.required, 'pk-icon-circle-success': field.data.required}"
					   @click.prevent="$parent.toggleRequired(field)"></a>
				</td>
			</div>
			<div class="pk-table-width-150 pk-table-max-width-150 uk-text-truncate">
				{{ type.label }}
			</div>
		</div>


	</li>

</script>