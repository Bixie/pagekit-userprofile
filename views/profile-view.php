<?php
/**
 * @var $view \Pagekit\View\View
 * @var $profileUser \Bixie\Userprofile\User\ProfileUser
 */

$view->script('userprofiles-view', 'bixie/userprofile:app/bundle/userprofiles-view.js', ['vue']);

?>

<div id="userprofile-profile-view">

	<div class="uk-grid">
		<div class="uk-width-medium-3-4">

			<h1 class="uk-article-title"><?= $profileUser->get('name') ?></h1>

			<dl class="uk-description-list-horizontal">
				<dt><?= __('Email') ?></dt>
				<dd><?= $profileUser->get('email') ?></dd>
				<?php foreach ($profileUser->getProfileValues() as $profileValue) : ?>
					<dt><?= $profileValue['label'] ?></dt>
					<?php foreach ($profileValue['formatted'] as $value) : ?>
						<dd><?= $value ?></dd>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</dl>

		</div>
		<div class="uk-width-medium-1-4">
			<div class="uk-panel uk-panel-box uk-text-center">

				<div class="uk-panel-teaser">
					<img height="280" width="280" alt="<?= $profileUser->get('username') ?>"
						 v-gravatar.literal="<?= $profileUser->get('email') ?>">
				</div>

				<h3 class="uk-panel-title uk-margin-bottom-remove"><?= $profileUser->get('username') ?></h3>

			</div>
		</div>

		<a href="<?= $view->url('@userprofile/profiles') ?>"><?= __('Back to Profiles list') ?></a>
	</div>
</div>
