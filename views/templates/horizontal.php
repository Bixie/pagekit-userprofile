<?php
/**
 * @var array $config
 * @var Bixie\Userprofile\User\ProfileUser $profileUser
 * @var \Pagekit\Site\Model\Node $node
 */
$show_values = array_filter($profileUser->getProfileValues(), function ($profileValue) use ($config) {
    return in_array($profileValue['slug'], $config['list']['show_fields']);
});
$grid_width = [
    'col1' => 'uk-width-medium-1-3',
    'col2' => 'uk-width-medium-1-3',
    'col3' => 'uk-width-medium-1-3'
];
if (!$show_values && !$config['list']['show_image']) {
    $grid_width['col2'] = 'uk-width-1-1';
} elseif (!$config['list']['show_image'] || !$show_values) {
    $grid_width['col2'] = 'uk-width-medium-2-3';
}
if ($show_values && !$config['list']['show_image']) {
    $grid_width['col2'] = 'uk-width-medium-1-2';
    $grid_width['col3'] = 'uk-width-medium-1-2';
}

?>

<div class="uk-panel <?= $config['list']['panel_style'] ?>">
    <div class="uk-grid" data-uk-grid-margin>
        <?php if ($config['list']['show_image']) : ?>
        <div class="<?= $grid_width['col1'] ?>">
            <div class="uk-panel-teaser">
                <?= $profileUser->getAvatar() ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="<?= $grid_width['col2'] ?>">
            <?php if ($config['list']['show_title'] != 'none') : ?>
                <h3 class="<?= $config['list']['title_size'] ?> <?= $config['list']['title_color'] ?>">
                    <?php if ($config['list']['link_profile'] == 'title') : ?>
                    <a href="<?= $profileUser->getProfileUrl($node) ?>">
                        <?php endif; ?>
                        <?= $profileUser->get($config['list']['show_title']) ?>
                        <?php if ($config['list']['link_profile']) : ?>
                    </a>
                <?php endif; ?>
                </h3>
            <?php endif; ?>
            <dl class="uk-description-list-horizontal">
                <?php if ($config['list']['show_username']) : ?>
                    <dt><?= __('Username') ?></dt>
                    <dd><?= $profileUser->get('username') ?></dd>
                <?php endif; ?>
                <?php if ($config['list']['show_name']) : ?>
                    <dt><?= __('Name') ?></dt>
                    <dd><?= $profileUser->get('name') ?></dd>
                <?php endif; ?>
                <?php if ($config['list']['show_email']) : ?>
                    <dt><?= __('Email') ?></dt>
                    <dd><?= $profileUser->get('email') ?></dd>
                <?php endif; ?>
            </dl>
        </div>

        <?php if ($show_values) : ?>

            <div class="<?= $grid_width['col3'] ?>">
                <dl class="uk-description-list-horizontal">
                    <?php foreach ($profileUser->getProfileValues() as $profileValue) :
                        if (!in_array($profileValue['slug'], $config['list']['show_fields'])) continue;
                        ?>
                        <dt><?= $profileValue['label'] ?></dt>
                        <?php foreach ($profileValue['formatted'] as $value) : ?>
                        <dd><?= $value ?></dd>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                </dl>
            </div>

        <?php endif; ?>
    </div>

    <?php if ($config['list']['link_profile'] == 'panel') : ?>
        <a class="uk-position-cover" href="<?= $view->url('@userprofile/profiles/id', ['id' => $profileUser->id]) ?>"></a>
    <?php endif; ?>

</div>
