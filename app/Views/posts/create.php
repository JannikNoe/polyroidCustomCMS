<h1> Write a Post</h1>

<form method="post" action="/posts/create" enctype="multipart/form-data">

    <?php if (isset($errors['root'])): ?>
        <div class="error"><?=$errors['root']?></div>
    <?php endif; ?>

    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" />
        <?php if (isset($errors['title'])): ?>
            <div class="error"><?=$errors['title'][0]?></div>
        <?php endif; ?>
    </div>

    <div>
        <label for="body">Body</label>
        <textarea name="body" id="body"></textarea>
        <?php if (isset($errors['body'])): ?>
            <div class="error"><?=$errors['body'][0]?></div>
        <?php endif; ?>
    </div>

    <div>
        <label for="image">Image</label>
        <input type="file" id="image" name="image"
        <?php if (isset($errors['image'])): ?>
            <div class="error"><?=$errors['image'][0]?></div>
        <?php endif; ?>
    </div>

    <input type="submit" value="Create Post">

</form>