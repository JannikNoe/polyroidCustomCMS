<div class="col-sp-12 col-sd-10 row-sp-12">
    <div class="content-1200">
        <div class="dashboardWrapper">
            <div class="headline-wrapper flex">
                <h2>Post erstellen</h2>
                <button class="button"><a href="/dashboard">zurück</a></button>
            </div>

            <div class="col-sp-12 col-sd-12 row-sp-12">
                <div class="mobile-note"><p>Die Redaktion empfiehlt die Erstellung von Posts an Desktop Devices vorzunehmen.</p></div>

                <form method="post" action="/posts/create" enctype="multipart/form-data">

                    <?php if (isset($errors['root'])): ?>
                        <div class="error"><?=$errors['root']?></div>
                    <?php endif; ?>

                    <div class="contentInput-wrapper">
                        <label for="title">Headline</label>
                        <span class="post-requirements">Anforderungen: min 10 / max 64 Zeichen, keine Umlaute</span>
                        <textarea id="title" name="title" ></textarea>
                        <?php if (isset($errors['title'])): ?>
                            <div class="error"><?=$errors['title'][0]?></div>
                        <?php endif; ?>
                    </div>

                    <div class="contentInput-wrapper">
                        <label for="body">Body</label>
                        <span class="post-requirements">Anforderungen: min 100 Zeichen</span>
                        <textarea name="body" id="body" rows="20"></textarea>
                        <?php if (isset($errors['body'])): ?>
                            <div class="error"><?=$errors['body'][0]?></div>
                        <?php endif; ?>
                    </div>

                    <div class="contentInput-wrapper">
                        <label for="image">Image</label>
                        <span class="post-requirements">Anforderungen: max 2mb | 1280 × 720</span>
                        <input type="file" id="image" name="image">
                        <?php if (isset($errors['image'])): ?>
                            <div class="error"><?=$errors['image'][0]?></div>
                        <?php endif; ?>
                    </div>
                    <div class="submit">
                        <input class="submitButton" type="submit" value="Create Post">
                    </div>

                </form>
            </div>

