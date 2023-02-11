
<h2><?= $post->getTitle()?></h2>
<div style="display: flex; column-gap: 12px;">
    <div>Posted by: <?= $post->getUser()->getUsername()?></div>
    <div>Posted at: <?=$post->getCreatedAt() ?></div>
</div>
<?php foreach ($post->getImages() as $image): ?>
    <img src="<?= $image ?>">
<?php endforeach;?>
<p><?=$post->getBody()?></p>

<?php if($user->isLoggedIn() && ($user->getId() === $post->getUserId())): ?>
    <button style=" flex: 0.1; background-color: red; color: white; border: none; padding: 6px 8px; border-radius: 4px; "><a style="text-decoration: none; color: white;" href="/posts/delete/<?= $post->getId()?>">Delete this Post</a></button>
<?php endif; ?>


