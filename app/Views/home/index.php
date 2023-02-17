<div class="col-sp-12 col-sd-10 row-sp-12">
    <div class="content-1000">
        <div class="dashboardWrapper">
            <div class="col-sp-12 col-sd-12 row-sp-12">
                <div class="viewWrapper">
                    <div class="mainArticle">
                        <h6>Die besten Memes aus The Office: Humor im Alltag</h6>
                        <h3>Eine Untersuchung der Auswirkungen und der anhaltenden Beliebtheit von The Office Memes</h3>
                        <img src="src/images/30fdc1b4fb4bc51c285dd17b3548aeca.webp" alt=""/>
                        <p>Von 'Das hat sie gesagt' bis hin zu 'Bären, Beats, Battlestar Galactica' - Tauchen Sie ein in die Welt der besten Memes aus The Office und erfahren Sie mehr über ihren Einfluss und ihre anhaltende Beliebtheit.</p>
                        <button class="button"><a href="http://localhost:8888/posts/48/eine-untersuchung-der-auswirkungen-beliebter-the-office-memes">Jetzt lesen</a></button>
                    </div>

                </div>
                <div class="memesList-wrapper">

                </div>
                <div class="lastMemes-wrapper">
                    <h2>Memes aus aller Welt</h2>
                    <div class="memeChoices flex" id="memeChoices">

                        <iframe src="https://giphy.com/embed/13hIkIWmBwkoXm" width="300" height="254" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                        <iframe src="https://giphy.com/embed/i79P9wUfnmPyo" width="300" height="270" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                        <iframe src="https://giphy.com/embed/zLBdm3FLPtrwrkyZ2P" width="300" height="260" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>

                    </div>
                </div>
                <h2>Zuletzt veröffentlichte Artikel</h2>

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
                                    <button class="button"><a style="text-decoration: none; color: white;" href="/posts/<?= $post->getId()?>/<?=$post->getSlug()?>">Jetzt lesen</a></button>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

                </div>
                <div class="memeSlider">
                    <h2>Memewoche</h2>
                    <div class="slider">
                        <div class="slider-container">

                            <img src="src/images/memes/322162509_842677773629138_5720870363097533822_n.jpg" alt="Slide 1">

                            <img src="src/images/memes/323875138_202259078979012_4768829339538506900_n.jpg" alt="Slide 2">

                            <img src="src/images/memes/325601423_1267843667275493_4634455524026935569_n.jpg" alt="Slide 3">

                            <img src="src/images/memes/327158999_700583694852096_6712776938212832038_n.jpg" alt="Slide 3">

                            <img src="src/images/memes/328062925_166843722482772_8950200725298014879_n.jpg" alt="Slide 4">

                            <img src="src/images/memes/329051057_220459090360909_8703159725996875332_n.jpg" alt="Slide 5">

                            <img src="src/images/memes/330474073_206056695418146_531868456343602192_n.jpg" alt="Slide 6">


                        </div>
                        <button class="slider-btn slider-btn-prev">&lt;</button>
                        <button class="slider-btn slider-btn-next">&gt;</button>
                    </div>
                </div>
            </div>