<div class="col-sp-12 col-sd-10 row-sp-12">
    <div class="content-1200">
        <div class="postView-wrapper">
            <div class="headline-wrapper flex" style="justify-content: right">
                <?php if($user->isLoggedIn() && ($user->getId() === $post->getUserId())): ?>
<!--                    <h2>Dashboard</h2>-->
                    <button class="button-second" "><a style="text-decoration: none; color: white;" href="/posts/delete/<?= $post->getId()?>">Delete this Post</a></button>
                <?php endif; ?>
            </div>

            <div class="col-sp-12 col-sd-12 row-sp-12">
                <div class="articleHeadline">
                   <h6>Subtitle Placeholder</h6>
                    <h3><?= $post->getTitle()?></h3>
                    <div class="postedAt">Gepostet am: <?=$post->getCreatedAt() ?></div>
                    <?php foreach ($post->getImages() as $image): ?>
                        <img src="<?= $image ?>">
                    <?php endforeach;?>
                </div>
                <p><?=$post->getBody()?></p>



            </div>


