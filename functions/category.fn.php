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
function getCategories($link)
{
    $sql = 'SELECT * FROM category';
    $result = mysqli_query($link, $sql);

    $categories = [];
    while ($category = mysqli_fetch_assoc($result)) {
        $categories[] = $category;
    }

    return $categories;
}

/**
 * @param $link
 * @param $id
 *
 * @return array|null
 */
function getCategory($link, $id)
{
    $sql    = 'SELECT * FROM category WHERE id='.mysqli_real_escape_string($link, $id);
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
function addCategory($link, $name, array $image = null)
{
    $imageName = saveCategoryImageFile($image);
    $sql     = 'INSERT INTO category (id, name, image) VALUES (NULL, ?, ?)';
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
function updateCategory($link, $id, array $update)
{
    $sql = 'UPDATE category SET ';

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
function removeCategory($link, $id)
{
    $sqlImage = 'SELECT image FROM category WHERE id='.mysqli_real_escape_string($link, $id);
    $resultImage = mysqli_query($link, $sqlImage);
    $imageName = __DIR__.'/../'.mysqli_fetch_assoc($resultImage)['image'];

    $sql = 'DELETE FROM category WHERE id='.mysqli_real_escape_string($link, $id);
    $successfullyRemoved = mysqli_query($link, $sql);

    if ($successfullyRemoved) {
        removeCategoryImageFile($imageName);
    }

    return $successfullyRemoved;
}

/**
 * @param array $image
 *
 * @return null|string
 */
function saveCategoryImageFile(array $image = null) {
    if (null !== $image && 0 === $image['error']) {
        $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];

        $salt = sha1(uniqid(mt_rand(), true));
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $imageName = 'uploads/category/'.$salt.'.'.$extension;
        if (in_array($extension, $allowedExtensions))
            move_uploaded_file($image['tmp_name'], __DIR__.'/../'.$imageName);
        else
            $imageName = null;
    } else
        $imageName = null;

    return $imageName;
}

/**
 * @param null $fileName
 *
 * @return bool|null
 */
function removeCategoryImageFile($fileName = null) {
    if ($fileName && is_file($fileName)) {
        return unlink($fileName);
    }
    return null;
}
