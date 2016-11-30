<?php
/**
 * @var array $config
 * @var Bixie\Userprofile\User\ProfileUser $profileUser
 * @var \Pagekit\Site\Model\Node $node
 */
?>

<div class="uk-panel <?= $config['list']['panel_style'] ?>">
    <?php if ($config['list']['show_image']) : ?>
        <div class="uk-panel-teaser">
            <?= $profileUser->getAvatar() ?>
        </div>
    <?php endif; ?>

    <?php if ($config['list']['show_title'] != 'none') : ?>
        <h3 class="<?= $config['list']['title_size'] ?> <?= $config['list']['title_color'] ?>">
            <?php if ($config['list']['link_profile'] == 'title') : ?>
                <a href="<?= $view->url('@userprofile/profiles/id', ['id' => $profileUser->id]) ?>">
            <?php endif; ?>
            <?= $profileUser->get($config['list']['show_title']) ?>
            <?php if ($config['list']['link_profile']) : ?>
                </a>
            <?php endif; ?>
        </h3>
    <?php endif; ?>

    <dl>
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
        <?php foreach ($profileUser->getProfileValues() as $profileValue) :
            if (!in_array($profileValue['slug'], $config['list']['show_fields'])) continue;
            ?>
            <dt><?= $profileValue['label'] ?></dt>
            <?php foreach ($profileValue['formatted'] as $value) : ?>
            <dd><?= $value ?></dd>
        <?php endforeach; ?>
        <?php endforeach; ?>
    </dl>

    <?php if ($config['list']['link_profile'] == 'panel') : ?>
        <a class="uk-position-cover" href="<?= $view->url('@userprofile/profiles/id', ['id' => $profileUser->id]) ?>"></a>
    <?php endif; ?>

</div>
