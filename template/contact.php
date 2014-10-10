<?php include __DIR__.'/_header.php'; ?>

    <h1>Contact</h1>

    <form action="" method="post">
        <label for="name">Name: </label>
        <input id="name" name="name" type="text">
        <br>
        <label for="content">Content: </label>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <br>
        <input name="submitContact" type="submit">
    </form>

<?php include __DIR__.'/_footer.php'; ?>