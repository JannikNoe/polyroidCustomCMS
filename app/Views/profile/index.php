
<form method="post" enctype="multipart/form-data">
    <div>
        <label for="file_upload">File</label>
        <input type="file" id="file_upload" name="upload" accept="image/*">
    </div>
    <div>
        <label for="text">Alternativtext</label>
        <textarea name="text" id="text">
        </textarea>
    </div>
    <div>
        <input type="submit" value="uploadImage">
    </div>
</form>
<!--<ul>-->
<!--    --><?php //foreach( getImages() as $image ): ?>
<!--        <li>-->
<!--            <img src="--><?//= $image[ 'path' ] ?><!--" alt="--><?//= $image[ 'alttext' ] ?><!--">-->
<!--        </li>-->
<!--    --><?php //endforeach; ?>
<!--</ul>-->
