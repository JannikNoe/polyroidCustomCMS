
<h2><?= $post->getTitle()?></h2>
<div style="display: flex; column-gap: 12px;">
    <div>Posted by: <?= $post->getUser()->getUsername()?></div>
    <div>Posted at: <?=$post->getCreatedAt() ?></div>
</div>
<?php foreach ($post->getImages() as $image): ?>
    <img src="<?= $image ?>">
<?php endforeach;?>
<p><?=$post->getBody()?></p>


