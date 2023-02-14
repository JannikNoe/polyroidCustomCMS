<div class="col-sp-12 col-sd-10 row-sp-12">
    <div class="dashboardWrapper">
        <h2>Dashboard</h2>
        <div class="col-sp-12 col-sd-12 row-sp-12">

            <div class="dashboardOverview flex">
                <div class="overviewDetails flex">
                    <h5>Heutige Artikel</h5>
                    <div class="roundNumber">5</div>
                </div>
                <div class="overviewDetails flex">
                    <h5>Artikel in Überprüfung</h5>
                    <div class="roundNumber">5</div>
                </div>
                <div class="overviewDetails flex">
                    <h5>Abgelehnte Artikel</h5>
                    <div class="roundNumber">5</div>
                </div>
            </div>
        </div>
        <h2>Dashboard</h2>
        <div class="col-sp-12 col-sd-12 row-sp-12">
            <div class="lastPosts">
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

                    </div>
                <?php endforeach; ?>
            </div>

            <div style="margin-top: 400px"></div>
            <dl>
                <dt>Email</dt>
                <dd> <?=$user->getEmail()?> </dd>
                <dt>Username</dt>
                <dd> <?=$user->getUsername()?> </dd>
            </dl>

        </div>
    </div>


</div>








