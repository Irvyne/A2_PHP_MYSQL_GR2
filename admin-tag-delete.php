<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header-admin.php';

if (!empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    removeTag($link, $id);
}

header('Location: admin-tag-list.php');

require __DIR__.'/_footer.php';