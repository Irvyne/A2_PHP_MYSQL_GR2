<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

include __DIR__.'/functions/database.fn.php';
$config = include __DIR__.'/config/config.php';

$link = getDatabaseLink($config['database']);

var_dump(mysqli_error($link));
