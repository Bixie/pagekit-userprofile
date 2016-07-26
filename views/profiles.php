<?php
/**
 * @var $view \Pagekit\View\View
 * @var $config array
 * @var $total int
 * @var $page int
 * @var $profileUsers \Bixie\Userprofile\User\ProfileUser[]
 */

$view->script('userprofiles', 'bixie/userprofile:app/bundle/userprofiles.js', ['vue']);
// Grid
$grid  = 'uk-grid-width-1-'.$config['list']['columns'];
$grid .= $config['list']['columns_small'] ? ' uk-grid-width-small-1-'.$config['list']['columns_small'] : '';
$grid .= $config['list']['columns_medium'] ? ' uk-grid-width-medium-1-'.$config['list']['columns_medium'] : '';
$grid .= $config['list']['columns_large'] ? ' uk-grid-width-large-1-'.$config['list']['columns_large'] : '';
$grid .= $config['list']['columns_xlarge'] ? ' uk-grid-width-xlarge-1-'.$config['list']['columns_xlarge'] : '';

?>
<div id="userprofile-profiles">

	<h1 class="uk-article-title"><?= __('Profiles list') ?></h1>

	<div class="uk-grid uk-grid-match <?= $grid ?>" data-uk-grid-match="{target: '>.uk-panel'}" data-uk-grid-margin>
		<?php foreach ($profileUsers as $profileUser) : ?>
			<div>
				<div class="uk-panel <?= $config['list']['panel_style'] ?>">
					<div class="uk-panel-teaser">
						<img height="280" width="280" alt="<?= $profileUser->get('username') ?>" v-gravatar.literal="<?= $profileUser->get('email') ?>">
					</div>

					<?php if ($config['list']['show_title'] != 'none') : ?>
						<h3 class="<?= $config['list']['title_size'] ?> <?= $config['list']['title_color'] ?>">
							<?= $profileUser->get($config['list']['show_title']) ?>
						</h3>
					<?php endif; ?>

					<a class="uk-position-cover" href="<?= $view->url('@userprofile/profiles/id', ['id' => $profileUser->id]) ?>"></a>

				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<?php
	$range     = 3;
	$total     = intval($total);
	$page      = intval($page);
	$pageIndex = $page - 1;
	?>

	<?php if ($total > 1) : ?>
		<ul class="uk-pagination">

			<?php for($i=1;$i<=$total;$i++): ?>
				<?php if ($i <= ($pageIndex+$range) && $i >= ($pageIndex-$range)): ?>

					<?php if ($i == $page): ?>
						<li class="uk-active"><span><?=$i?></span></li>
					<?php else: ?>
						<li>
							<a href="<?= $view->url('@userprofile/profiles/page', ['page' => $i]) ?>"><?=$i?></a>
						<li>
					<?php endif; ?>

				<?php elseif($i==1): ?>

					<li>
						<a href="<?= $view->url('@userprofile/profiles/page', ['page' => 1]) ?>">1</a>
					</li>
					<li><span>...</span></li>

				<?php elseif($i==$total): ?>

					<li><span>...</span></li>
					<li>
						<a href="<?= $view->url('@userprofile/profiles/page', ['page' => $total]) ?>"><?=$total?></a>
					</li>

				<?php endif; ?>
			<?php endfor; ?>

		</ul>
	<?php endif ?>


</div>
