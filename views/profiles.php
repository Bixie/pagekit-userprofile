<?php

?>

<ul class="uk-list uk-list-line">
	<?php foreach ($users as $user) : ?>
		<li>
			<a href="<?= $view->url('@userprofile/profiles/id', ['id' => $user->id]) ?>"><?= $user->username ?></a>
		</li>
	<?php endforeach; ?>
</ul>
