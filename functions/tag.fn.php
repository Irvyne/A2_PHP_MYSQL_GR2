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
function getTags($link)
{
    $sql = 'SELECT * FROM tag';
    $result = mysqli_query($link, $sql);

    $tags = [];
    while ($tag = mysqli_fetch_assoc($result)) {
        $tags[] = $tag;
    }

    return $tags;
}

/**
 * @param $link
 * @param $id
 *
 * @return array|null
 */
function getTag($link, $id)
{
    $sql    = 'SELECT * FROM tag WHERE id='.mysqli_real_escape_string($link, $id);
    $result = mysqli_query($link, $sql);

    return mysqli_fetch_assoc($result);
}

/**
 * @param       $link
 * @param       $name
 * @param array $image
 *
 * @return bool
 */
function addTag($link, $name, array $image = null)
{
    $imageName = saveTagImageFile($image);
    $sql     = 'INSERT INTO tag (id, name, image) VALUES (NULL, ?, ?)';
    $prepare = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($prepare, 'ss', $name, $imageName);
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
function updateTag($link, $id, array $update)
{
    $sql = 'UPDATE tag SET ';

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

    return mysqli_query($link, $sql);
}

/**
 * @param $link
 * @param $id
 *
 * @return bool|mysqli_result
 */
function removeTag($link, $id)
{
    $sql = 'DELETE FROM tag WHERE id='.mysqli_real_escape_string($link, $id);
    $result = mysqli_query($link, $sql);

    return $result;
}