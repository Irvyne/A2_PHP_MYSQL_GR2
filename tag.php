<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header.php';

if (!empty($_GET['id'])) {
    $id = (int) $_GET['id'];
    $tag = getTag($link, $id);
    if (!$tag) {
        header('Location: categories.php');
    }
    $articles = getArticlesFromTag($link, $tag['id']);
} else {
    header('Location: index.php');
}

require __DIR__.'/_footer.php';

include __DIR__.'/template/articles.php';