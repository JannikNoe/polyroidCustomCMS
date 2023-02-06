<h1> Write a Post</h1>

<form method="post" action="/posts/create">

    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" />
    </div>

    <div>
        <label for="body">Body</label>
        <textarea name="body" id="body">
        </textarea>
    </div>

    <input type="submit" value="Create Post">

</form>