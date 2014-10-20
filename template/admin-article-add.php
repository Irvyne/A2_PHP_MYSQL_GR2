<?php include __DIR__.'/_header.php'; ?>

<h1>Administration: List Articles</h1>

<form action="" method="post" role="form" enctype="multipart/form-data">
    <label for="title">Title: </label>
    <input id="title" class="form-control" name="title" type="text" placeholder="Title" required autofocus <?php if (!empty($article['title'])) { echo 'value="'.$article['title'].'"'; } ?>>
    <br>

    <label for="content">Content: </label>
    <textarea id="content" class="form-control" name="content" cols="30" rows="10" required><?php if (!empty($article['content'])) { echo $article['content']; } ?></textarea>
    <br>

    <label for="enabled">Enabled: </label>
    <input id="enabled" class="form-control" name="enabled" type="checkbox" <?php if (!empty($article['enabled']) && 1 == $article['enabled']) { echo 'checked'; } ?>>
    <br>

    <label for="image">Image: </label>
    <input id="image" class="form-control" name="image" type="file">
    <br>

    <label for="category">Category: </label>
    <select id="category" class="form-control" name="category" required>
        <?php
        $categories = getCategories($link);
        foreach ($categories as $category) {
            echo '<option value="'.$category['id'].'"';
            if (!empty($article['category_id']) && $category['id'] == $article['category_id']) { echo ' selected'; }
            echo '>'.$category['name'].'</option>';
        }
        ?>
    </select>
    <br>

    <?php
    $tags = getTags($link);
    foreach ($tags as $tag) {
        echo '<label for="tag'.$tag['id'].'" class="checkbox-inline">';
            echo '<input type="checkbox" id="tag'.$tag['id'].'" name="tags[]" value="'.$tag['id'].'"> '.$tag['name'];
        echo '</label>';
    }
    ?>
    <br>
    <br>

    <input class="btn btn-default" name="submitArticle" type="submit" value="Submit Form">
</form>

<?php include __DIR__.'/_footer.php'; ?>