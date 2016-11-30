<?php
/**
 * @var $view \Pagekit\View\View
 * @var $config array
 * @var $profileUser \Bixie\Userprofile\User\ProfileUser
 * @var \Pagekit\Site\Model\Node $node
 */

$view->script('userprofiles-details', 'bixie/userprofile:app/bundle/userprofiles-details.js', ['vue']);

?>

<div id="userprofile-profile-details">

	<div class="uk-grid">
		<div class="uk-width-medium-3-4">

			<h1 class="uk-article-title"><?= $profileUser->get('name') ?></h1>

			<dl class="uk-description-list-horizontal">
				<?php if ($config['details']['show_email']) : ?>
					<dt><?= __('Email') ?></dt>
					<dd><?= $profileUser->get('email') ?></dd>
				<?php endif; ?>
				<?php foreach ($profileUser->getProfileValues() as $profileValue) :
						if (!in_array($profileValue['slug'], $config['details']['show_fields'])) continue;
					?>
					<dt><?= $profileValue['label'] ?></dt>
					<?php foreach ($profileValue['formatted'] as $value) : ?>
						<dd><?= $value ?></dd>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</dl>

		</div>
		<div class="uk-width-medium-1-4">
			<?php if ($config['details']['show_image'] || $config['details']['show_username']) : ?>
			<div class="uk-panel uk-panel-box uk-text-center">

				<?php if ($config['details']['show_image']) : ?>
					<div class="uk-panel-teaser">
						<?= $profileUser->getAvatar() ?>
					</div>
				<?php endif; ?>

				<?php if ($config['details']['show_username']) : ?>
					<h3 class="uk-panel-title uk-margin-bottom-remove"><?= $profileUser->get('username') ?></h3>
				<?php endif; ?>

			</div>
			<?php endif; ?>
		</div>
	</div>

	<p><a href="<?= $view->url($node->link) ?>"><?= __('Back to Profiles list') ?></a></p>
</div>
