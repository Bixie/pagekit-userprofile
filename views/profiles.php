<?php
/**
 * @var $view \Pagekit\View\View
 * @var $profileUsers \Bixie\Userprofile\User\ProfileUser[]
 */

$view->script('userprofiles', 'bixie/userprofile:app/bundle/userprofiles.js', ['vue']);

?>
<div id="userprofile-profiles">

	<h1 class="uk-article-title"><?= __('Profiles list') ?></h1>

	<div class="uk-grid uk-grid-match uk-grid-width-medium-1-4" data-uk-grid-match="{target: '>.uk-panel'}" data-uk-grid-margin>
		<?php foreach ($profileUsers as $profileUser) : ?>
			<div>
				<div class="uk-panel uk-panel-box">
					<div class="uk-panel-teaser">
						<img height="280" width="280" alt="<?= $profileUser->get('username') ?>" v-gravatar.literal="<?= $profileUser->get('email') ?>">
					</div>

					<h3 class="uk-panel-title"><?= $profileUser->get('name') ?></h3>

					<a class="uk-position-cover" href="<?= $view->url('@userprofile/profiles/id', ['id' => $profileUser->id]) ?>"></a>

				</div>
			</div>
		<?php endforeach; ?>
	</div>

</div>
