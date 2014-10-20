<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        ul.error {
            background-color: red;
        }
    </style>
</head>
<body>

<?php if (isset($errors) && sizeof($errors) > 0) : ?>
<ul class="error">
    <?php
    foreach($errors as $error) {
        echo '<li>'.$error.'</li>';
    }
    ?>
</ul>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data">
    <label for="title">Title: </label>
    <input id="title" name="title" type="text" placeholder="Title" required autofocus>
    <br>

    <label for="content">Content: </label>
    <textarea id="content" name="content" cols="30" rows="10" required></textarea>
    <br>

    <label for="enabled">Enabled: </label>
    <input id="enabled" name="enabled" type="checkbox">
    <br>

    <label for="image">Image: </label>
    <input id="image" name="image" type="file">
    <br>

    <label for="category">Category: </label>
    <select id="category" name="category" required>
        <?php
        $categories = getCategories($link);
        foreach ($categories as $category) {
            echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
        }
        ?>
    </select>
    <br>

    <label for="tag1">Dog </label>
    <input id="tag1" name="tags[]" type="checkbox" value="1">
    <label for="tag2">Cat </label>
    <input id="tag2" name="tags[]" type="checkbox" value="2">
    <label for="tag3">Bird </label>
    <input id="tag3" name="tags[]" type="checkbox" value="3">
    <label for="tag4">Pony </label>
    <input id="tag4" name="tags[]" type="checkbox" value="4">
    <label for="tag5">Unicorn </label>
    <input id="tag5" name="tags[]" type="checkbox" value="5">
    <br>

    <input name="submitArticle" type="submit" value="Submit Form">
</form>

</body>
</html>