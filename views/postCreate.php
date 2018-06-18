<div>
    <h1>Hello Create</h1>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="3072000">
        <label for="title">Titre</label>
        <input id="title" name="title" type="text" value="">
        <label for="body">Text</label>
        <textarea id="body" name="body"></textarea>
        <label for="thumb">Miniature</label>
        <input type="file" name="thumb[]" id="thumb">
        <input type="submit" value="Créer cet article">
        <input type="hidden" name="a" value="store">
        <input type="hidden" name="r" value="post">
    </form>
</div>