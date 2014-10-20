<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

include __DIR__.'/functions/database.fn.php';
include __DIR__.'/functions/user.fn.php';
include __DIR__.'/functions/article.fn.php';
include __DIR__.'/functions/category.fn.php';
include __DIR__.'/functions/tag.fn.php';
$config = include __DIR__.'/config/config.php';

$link = getDatabaseLink($config['database']);

session_start();
