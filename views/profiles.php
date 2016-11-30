<?php
/**
 * @var \Pagekit\View\View $view
 * @var array $config
 * @var int $total
 * @var int $page
 * @var string $search
 * @var string $title
 * @var \Pagekit\Site\Model\Node $node
 * @var \Bixie\Userprofile\User\ProfileUser[] $profileUsers
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


    <?php if ($node->get('show_search')) : ?>
        <div class="uk-margin-bottom uk-flex">
            <h1 class="uk-article-title uk-margin-remove uk-flex-item-1"><?= $title ?></h1>
            <form class="uk-form" action="<?= $view->url($node->link) ?>" method="get">
                <div class="uk-form-icon">
                    <i class="uk-icon-search"></i>
                    <input type="search" name="filter[search]" value="<?= $search ?>">
                </div>
                <button type="submit" class="uk-button"><?= __('Search') ?></button>
            </form>

        </div>
    <?php else : ?>
        <h1 class="uk-article-title"><?= $title ?></h1>
    <?php endif; ?>

	<div class="uk-grid uk-grid-match <?= $grid ?>" data-uk-grid-match="{target: '>.uk-panel'}" data-uk-grid-margin>
		<?php foreach ($profileUsers as $profileUser) : ?>
			<div>
				<?= $view->render(sprintf('bixie/userprofile/templates/%s.php', $config['list']['template']),
					['config' => $config, 'profileUser' => $profileUser, 'node' => $node]) ?>
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
							<a href="<?= $view->url($node->link . '/page', ['page' => $i]) ?>"><?=$i?></a>
						<li>
					<?php endif; ?>

				<?php elseif($i==1): ?>

					<li>
						<a href="<?= $view->url($node->link . '/page', ['page' => 1]) ?>">1</a>
					</li>
					<li><span>...</span></li>

				<?php elseif($i==$total): ?>

					<li><span>...</span></li>
					<li>
						<a href="<?= $view->url($node->link . '/page', ['page' => $total]) ?>"><?=$total?></a>
					</li>

				<?php endif; ?>
			<?php endfor; ?>

		</ul>
	<?php endif ?>


</div>
