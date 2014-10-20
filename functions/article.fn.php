<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

/**
 * @param      $link
 *
 * @param null $userId
 * @param null $from
 * @param null $number
 *
 * @return array
 */
function getArticles($link, $userId = null, $from = null, $number = null)
{
    //TODO https://github.com/Irvyne/A2_PHP_MYSQL_GR2
    $sql = 'SELECT * FROM article';

    if (null !== $userId) {
        $sql .= ' WHERE user_id = '.(int)$userId;
    }

    if (null !== $from && null !== $number) {
        $sql .= ' LIMIT '.(int)$from.', '.(int)$number;
    } elseif (null !== $from) {
        $sql .= ' LIMIT '.(int)$from.', 0';
    } elseif (null !== $number) {
        $sql .= ' LIMIT '.(int)$number;
    }

    // LIMIT 5
    // LIMIT 12, 6
    // LIMIT 5, 0

    $result = mysqli_query($link, $sql);

    $articles = [];
    while ($article = mysqli_fetch_assoc($result)) {
        $articles[] = $article;
    }

    return $articles;
}

/**
 * @param $link
 * @param $categoryId
 *
 * @return array
 */
function getArticlesFromCategory($link, $categoryId)
{
    $sql = 'SELECT * FROM article WHERE category_id='.mysqli_real_escape_string($link, $categoryId);
    $result = mysqli_query($link, $sql);

    $articles = [];
    while ($article = mysqli_fetch_assoc($result)) {
        $articles[] = $article;
    }

    return $articles;
}

/**
 * @param $link
 * @param $tagId
 *
 * @return array
 */
function getArticlesFromTag($link, $tagId)
{
    $sql = 'SELECT * FROM article JOIN article_tag at ON at.article_id='.mysqli_real_escape_string($link, $tagId);
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
    $sql    = 'SELECT * FROM article WHERE id='.mysqli_real_escape_string($link, $id);
    $result = mysqli_query($link, $sql);

    return mysqli_fetch_assoc($result);
}

/**
 * @param            $link
 * @param string     $title
 * @param string     $content
 * @param bool       $enabled
 * @param array|null $image
 * @param int        $category_id
 * @param int        $user_id
 * @param array      $tags
 *
 * @return bool
 */
function addArticle($link, $title, $content, $enabled, array $image = null, $category_id, $user_id, $tags = null)
{
    $imageName = saveArticleImageFile($image);
    $sql       = 'INSERT INTO article (id, title, content, enabled, created_at, updated_at, image, category_id, user_id) VALUES (NULL, ?, ?, ?, NOW(), NOW(), ?, ?, ?)';
    $prepare   = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($prepare, 'ssisii', $title, $content, $enabled, $imageName, $category_id, $user_id);
    $result = mysqli_stmt_execute($prepare);

    return $result;
}

/**
 * @param       $link
 * @param       $id
 * @param array $update
 *
 * @return bool|mysqli_result
 */
function updateArticle($link, $id, array $update)
{
    $sql = 'UPDATE article SET ';

    $update = array_merge($update, ['updated_at' => 'NOW()']);

    $i = 0;
    foreach ($update as $column => $value) {
        if ($i > 0) {
            $sql .= ', ';
        }
        $sql .= $column.'=';
        if (is_string($value)) {
            $sql .= '"';
        }
        $sql .= mysqli_real_escape_string($link, $value);
        if (is_string($value)) {
            $sql .= '"';
        }
        $i++;
    }

    $sql .= ' WHERE id='.mysqli_real_escape_string($link, $id);

    mysqli_query($link, $sql);
}

/**
 * @param $link
 * @param $id
 * @param $enabled
 *
 * @return bool|mysqli_result
 */
function enableArticle($link, $id, $enabled)
{
    $sql = 'UPDATE article SET enabled='.mysqli_real_escape_string(
            $link,
            $enabled
        ).' WHERE id='.mysqli_real_escape_string($link, $id);

    return mysqli_query($link, $sql);
}

/**
 * @param $link
 * @param $id
 *
 * @return bool|mysqli_result
 */
function removeArticle($link, $id)
{
    $sqlImage    = 'SELECT image FROM article WHERE id='.mysqli_real_escape_string($link, $id);
    $resultImage = mysqli_query($link, $sqlImage);
    $imageName   = __DIR__.'/../'.mysqli_fetch_assoc($resultImage)['image'];

    $sql                 = 'DELETE FROM article WHERE id='.mysqli_real_escape_string($link, $id);
    $successfullyRemoved = mysqli_query($link, $sql);

    if ($successfullyRemoved) {
        removeArticleImageFile($imageName);
    }

    return $successfullyRemoved;
}

/**
 * @param $link
 *
 * @return int
 */
function countArticles($link)
{
    $sql    = 'SELECT COUNT(*) AS nb FROM article';
    $result = mysqli_query($link, $sql);

    return (int)mysqli_fetch_assoc($result)['nb'];
}

/**
 * @param array $image
 *
 * @return null|string
 */
function saveArticleImageFile(array $image = null)
{
    if (null !== $image && 0 === $image['error']) {
        $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];

        $salt      = sha1(uniqid(mt_rand(), true));
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $imageName = 'uploads/article/'.$salt.'.'.$extension;
        if (in_array($extension, $allowedExtensions)) {
            move_uploaded_file($image['tmp_name'], __DIR__.'/../'.$imageName);
        } else {
            $imageName = null;
        }
    } else {
        $imageName = null;
    }

    return $imageName;
}

/**
 * @param null $fileName
 *
 * @return bool|null
 */
function removeArticleImageFile($fileName = null)
{
    if ($fileName && is_file($fileName)) {
        return unlink($fileName);
    }

    return null;
}

/**
 * @param $string
 * @param int $length
 * @return string
 */
function getExcerpt($string, $length = 300) {
    $excerpt = substr($string, 0, $length);
    if (strlen($string) > $length) {
        $excerpt .= '...';
    }
    return $excerpt;
}