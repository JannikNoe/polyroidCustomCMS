<h1>Dashboard</h1>



<h2>Dashboard</h2>

<dl>
    <dt>Email</dt>
    <dd> <?=$user->getEmail()?> </dd>
    <dt>Username</dt>
    <dd> <?=$user->getUsername()?> </dd>
</dl>

<div>
    <h3>Deine Posts</h3>

    <?php if (!count($posts)):?>
        <p>You don't currently have any posts.</p>
    <?php endif;?>

    <?php foreach ($posts as $post): ?>
        <div style="display: flex; column-gap: 12px; margin: 6px 0; justify-content: flex-start">
            <a style="flex: 0.3;" href="/posts/<?= $post->getId();?>/<?=$post->getSlug()?>">
            <?php echo $post->getTitle(); ?>
            </a>
            <button style=" flex: 0.1; background-color: red; color: white; border: none; padding: 6px 8px; border-radius: 4px; "><a style="text-decoration: none; color: white;" href="/posts/delete/<?= $post->getId()?>">Delete Post</a></button>
            <div style="flex: 1;"></div>
        </div>
    <?php endforeach; ?>
</div>