<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header.php';

$perPage = 6;
$total = countArticles($link);
$currentPage = !empty($_GET['p']) ? (int)$_GET['p'] : 0;
$lastPage = (int)floor($total/$perPage);

if (0 >= $currentPage) {
    header('Location: index.php?p=1');
}
if ($currentPage > ($lastPage+1)) {
    header('Location: index.php?p='.($lastPage+1));
}

$articles = getArticles($link, null, ($currentPage-1)*6, $perPage);

include __DIR__.'/template/articles.php';

require __DIR__.'/_footer.php';
