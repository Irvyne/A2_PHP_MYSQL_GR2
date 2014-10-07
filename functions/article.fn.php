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

/**
 * @param $link
 * @param $id
 *
 * @return array|null
 */
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
 * @param int    $category_id
 * @param int    $user_id
 * @param array  $tags
 *
 * @return bool
 */
function addArticle($link, $title, $content, $enabled, $image, $category_id, $user_id, $tags = null)
{
    $sql = 'INSERT INTO article (id, title, content, enabled, image, category_id, user_id) VALUES (NULL, ?, ?, ?, ?, ?, ?)';
    $prepare = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($prepare, 'ssisii', $title, $content, $enabled, $image, $category_id, $user_id);
    $result = mysqli_stmt_execute($prepare);

    return $result;
}

// $update = ['content' => 'Mon nouveau titre', 'category_id' => 0];
function updateArticle($link, $id, array $update)
{
    $sql = 'UPDATE article SET ';

    $i = 0;
    foreach ($update as $column => $value) {
        if ($i > 0) $sql .= ', ';
        $sql .= $column.'=';
        if (is_string($value)) $sql .= '"';
        $sql .= mysqli_real_escape_string($link, $value);
        if (is_string($value)) $sql .= '"';
        $i++;
    }

    $sql .= ' WHERE id='.mysqli_real_escape_string($link, $id);
    return mysqli_query($link, $sql);
}

function enableArticle($link, $id, $enabled)
{
    $sql = 'UPDATE article SET enabled='.mysqli_real_escape_string($link, $enabled).' WHERE id='.mysqli_real_escape_string($link, $id);

    return mysqli_query($link, $sql);
}

function removeArticle($link, $id)
{
    $sql = 'DELETE FROM article WHERE id='.mysqli_real_escape_string($link, $id);

    return mysqli_query($link, $sql);
}
