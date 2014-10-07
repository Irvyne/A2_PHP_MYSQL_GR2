<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

/**
 * @param $link
 *
 * @return array
 */
function getArticles($link)
{
    $sql = 'SELECT * FROM article';
    $result = mysqli_query($link, $sql);

    $articles = [];
    while ($article = mysqli_fetch_assoc($result)) {
        $articles[] = $article;
    }

    return $articles;
}

function getArticle($link, $id)
{
    $sql = 'SELECT * FROM article WHERE id='.mysqli_real_escape_string($link, $id);
    $result = mysqli_query($link, $sql);

    return mysqli_fetch_assoc($result);
}

/**
 * @param        $link
 * @param string $title
 * @param string $content
 * @param bool   $enabled
 * @param string $image
 * @param int    $category
 * @param array  $tags
 * @param int    $user
 */
function addArticle($link, $title, $content, $enabled, $image, $category, $tags, $user)
{

}

function updateArticle($link, $id, array $update)
{

}

function enableArticle($link, $id, $enabled)
{

}

function removeArticle($link, $id)
{

}
