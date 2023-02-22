<div class="col-sp-12 col-sd-10 row-sp-12">
    <div class="content-1200">
        <div class="dashboardWrapper">
            <div class="headline-wrapper flex">
                <h2>Dashboard</h2>
                <button class="button"><a href="/posts/create">Post erstellen</a></button>
            </div>

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
            <h2>Letzte Artikel</h2>
            <div class="col-sp-12 col-sd-12 row-sp-12">
                <div class="lastPosts">
                    <?php if (!count($posts)):?>
                        <p>You don't currently have any posts.</p>
                    <?php endif;?>

                    <div class="lastArticleBox">
                        <?php foreach ($posts as $post): ?>
                            <div class="lastArticleBoxContent-wrapper">
                                <?php foreach ($post->getImages() as $image): ?>
                                    <img src="<?= $image ?>">
                                <?php endforeach;?>
                                <a href="/posts/<?= $post->getId();?>/<?=$post->getSlug()?>">
                                    <?php echo $post->getTitle(); ?>
                                </a>
                                <div class="lastArticleBoxContentButtons">
                                    <button class="button"><a style="text-decoration: none; color: white;" href="/posts/edit/<?= $post->getId()?>/<?=$post->getSlug()?>">Bearbeiten</a></button>
                                    <button class="button-delete"><a style="text-decoration: none; color: white;" href="/posts/delete/<?= $post->getId()?>"><img src="/src/images/icons/delete_FILL1_wght400_GRAD0_opsz48.svg"></a></button>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>








