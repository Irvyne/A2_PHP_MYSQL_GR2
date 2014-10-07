<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

include __DIR__.'/functions/database.fn.php';
include __DIR__.'/functions/article.fn.php';
$config = include __DIR__.'/config/config.php';

$link = getDatabaseLink($config['database']);

$boolean = addArticle($link, 'zff', 'cz', 1, null, 0, 0);
var_dump($boolean);
