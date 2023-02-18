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
                                    <button class="button"><a style="text-decoration: none; color: white;" href="/posts/edit/<?= $post->getId()?>/<?=$post->getSlug()?>">Edit Post</a></button>
                                    <button class="button-delete"><a style="text-decoration: none; color: white;" href="/posts/delete/<?= $post->getId()?>"><img src="/src/images/icons/delete_FILL1_wght400_GRAD0_opsz48.svg"></a></button>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
                <div style=""></div>
                <dl>
                    <dt>Email</dt>
                    <dd> <?=$user->getEmail()?> </dd>
                    <dt>Username</dt>
                    <dd> <?=$user->getUsername()?> </dd>
                </dl>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad blanditiis culpa dolorem magni nemo vel? Accusantium distinctio est fuga illo molestias possimus, repellendus temporibus ut veniam voluptatum? Aliquam amet animi asperiores at consectetur corporis culpa dicta dolor doloribus ea eveniet, facilis in inventore, itaque modi mollitia nulla praesentium quas rem repellendus saepe sit suscipit tempora tenetur veniam, voluptate voluptatum! Accusamus assumenda beatae, consequuntur est facilis fugiat ipsam reprehenderit temporibus totam veritatis! Assumenda atque commodi consequatur corporis delectus deserunt distinctio dolorem, eaque expedita, harum impedit ipsa ipsam iste, maxime molestiae necessitatibus nemo nobis perferendis porro possimus praesentium quam ratione rerum sapiente sit soluta tempore tenetur unde veniam voluptatibus! Alias animi aspernatur, blanditiis cupiditate dolores, expedita incidunt itaque laudantium magni minima nemo neque numquam odit perferendis quaerat quis quisquam recusandae reiciendis sequi vero. Adipisci at consequatur corporis dolorem eaque enim, eum facere maiores modi natus non odit omnis provident quaerat reiciendis reprehenderit rerum totam voluptate. Ad quod sequi tempore. Deleniti eius eligendi excepturi modi perspiciatis quod tempora vero! Ab, accusantium cumque debitis dolorum earum ipsum nisi non, numquam pariatur reprehenderit similique veritatis vitae voluptatem! Autem, consequatur dicta dolore eligendi eum id impedit in iste laudantium, molestias nesciunt non pariatur perferendis quam quia quo voluptas. Blanditiis enim eveniet id nobis qui sequi sunt? Eveniet libero nostrum quis ratione ut. Adipisci aperiam blanditiis dolore dolorem ducimus eos error, ex facilis incidunt molestiae nesciunt perferendis qui quibusdam quis quod rerum sequi tenetur unde voluptate voluptates? Deserunt earum, eligendi hic illo iusto odit omnis quibusdam ratione, rem sapiente, soluta temporibus voluptatem voluptates! Atque deserunt error eveniet harum in mollitia perspiciatis quae quaerat quidem rem. Deserunt doloribus ea facilis natus, tempora velit voluptas! Aliquam asperiores assumenda corporis delectus dolores est et facere fugiat fugit id illo illum in ipsa ipsam magni minus mollitia, numquam possimus quae qui quos repellat sed soluta sunt tempore temporibus, tenetur vero vitae, voluptates voluptatibus. Ad aliquam amet cum delectus dignissimos eaque eligendi esse, eum facere iure molestiae officia perspiciatis quae repellat suscipit ullam veritatis voluptatum. Accusamus ad alias animi, asperiores at, aut distinctio dolores earum esse molestiae nobis porro quas quo ratione recusandae tempore veritatis! Accusantium alias aliquid, architecto assumenda aut cum dignissimos dolores error explicabo itaque iusto necessitatibus omnis perspiciatis porro, quidem ratione saepe sequi, similique. Assumenda consectetur fuga laudantium quibusdam veniam. Delectus dignissimos iste optio quidem soluta vel voluptas. Doloremque dolores eaque est, eveniet necessitatibus nesciunt! Aspernatur dolores, dolorum ea error facere libero necessitatibus nesciunt nihil officiis omnis, perferendis provident recusandae, repellat reprehenderit similique tempore voluptatibus? Accusantium aut harum illo temporibus? Assumenda consectetur dolorem dolorum earum facilis iste laborum, nostrum rem reprehenderit sequi, suscipit vel velit voluptas. Accusantium alias architecto aspernatur atque aut beatae blanditiis cupiditate dolor, doloremque esse fugit natus necessitatibus neque nesciunt nobis odit, quibusdam quisquam quod recusandae repellat tenetur veniam voluptates voluptatibus. Error laudantium libero modi saepe sit. Amet aspernatur consectetur consequuntur, deserunt doloremque dolores ducimus eaque, earum enim est ex excepturi hic id inventore magnam necessitatibus officia pariatur praesentium ullam veniam? Ab eum, inventore molestiae praesentium quasi quis recusandae voluptas! Accusamus alias aliquid amet assumenda, at consectetur corporis, culpa cum cumque delectus dolorem doloremque eaque eius et eum expedita fugiat inventore ipsam itaque iusto laboriosam laudantium magnam neque nesciunt quae quibusdam quidem reiciendis saepe sunt voluptas. Adipisci aliquid cum debitis earum excepturi expedita incidunt, ipsum itaque laudantium molestias nam nisi obcaecati officiis omnis possimus quam quo quod repellat reprehenderit, similique sunt velit voluptate. Accusantium assumenda blanditiis dicta, dignissimos explicabo harum id inventore obcaecati, odit, possimus repudiandae sit! Aperiam assumenda libero officia ratione tempore. Aspernatur exercitationem expedita ipsa officia pariatur praesentium similique soluta totam ut? A at ex ipsum quibusdam voluptatem. Repellendus sit veritatis voluptate. Aspernatur aut corporis culpa cum cupiditate dolor dolores doloribus ea expedita explicabo in iste molestiae natus non pariatur placeat, saepe sit tempora? A cum dignissimos dolor dolores eligendi error esse illum inventore itaque maiores officia, omnis placeat quaerat reiciendis rerum veniam vitae! Asperiores, distinctio earum facilis ipsa nesciunt quibusdam! Ab aliquid aperiam assumenda corporis cum delectus earum error est eum eveniet exercitationem expedita explicabo in inventore, ipsa ipsam, iusto minima nam nemo nihil placeat possimus quam quas quidem quisquam quo quos recusandae rem reprehenderit repudiandae rerum saepe similique tempora veniam voluptas voluptate voluptatibus? Alias atque autem consequuntur iusto, laborum nesciunt numquam odio quae, quam quos sapiente vitae! Cumque doloremque incidunt minima quaerat velit veniam? Facilis in itaque odio ratione vero. Ab aperiam assumenda beatae culpa cum deleniti deserunt dolor earum esse facilis hic illum molestiae natus, nisi odio officiis reiciendis sed tenetur ut voluptas. Aspernatur at commodi distinctio doloribus eaque earum eligendi esse est eveniet expedita hic id, ipsa ipsam itaque iusto labore laboriosam laborum maxime mollitia natus nemo nesciunt nihil nostrum obcaecati odit pariatur praesentium qui quia quo saepe sunt tenetur veritatis vitae. Cum ex facere fugit impedit labore mollitia, optio quia sapiente! Aperiam consequuntur ea esse id illum ipsam itaque natus nihil quam, quisquam repudiandae sequi voluptate! Aspernatur atque autem delectus deleniti dolore enim eum facilis illum laudantium maxime neque, nesciunt officia officiis perferendis, quas sequi temporibus tenetur ut vitae voluptate? Alias aut, commodi consequatur cum dolores harum illum in, iste laborum molestiae quaerat quis sequi soluta vero voluptate. Accusantium aperiam facere impedit iusto libero reiciendis rem veritatis, vero voluptates voluptatum. Adipisci amet consectetur dolorem enim eos fugit, iste iure laboriosam neque provident quos reiciendis repudiandae tempora, temporibus, totam! Animi assumenda cupiditate dolore dolorum exercitationem expedita facilis fugiat maxime molestiae obcaecati, officiis porro repellat reprehenderit sit temporibus ullam voluptate. Assumenda aut eveniet exercitationem facere illo inventore ipsam iste, labore magnam maxime minima molestias numquam odit pariatur, quae quia, quos rem repellendus rerum similique temporibus velit veniam? Deserunt dolor dolore fugiat labore modi nisi nulla, perspiciatis qui quisquam reiciendis suscipit tenetur? Accusamus molestias nesciunt quam! Ab accusamus ad adipisci atque commodi culpa dicta dolor doloribus ea earum enim esse est expedita facilis fuga fugit illum incidunt iste laboriosam nemo nesciunt nihil nisi nostrum odio, odit quam quasi recusandae rerum sequi similique sit temporibus vel veniam vero vitae voluptate voluptatum. Deserunt, libero.</p>


            </div>
        </div>
    </div>

</div>








