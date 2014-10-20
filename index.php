<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header.php';

$perPage = 6; // nbArticleParPage
$nbArticles = countArticles($link); //nbArticleTotal
$currentPage = !empty($_GET['p']) ? (int)$_GET['p'] : 1;// numéro de la page
$nbPages = ceil($nbArticles/$perPage); // nombre de pagination


if (0 >= $currentPage) {
    header('Location: index.php?p=1');
}
if ($currentPage > $nbPages) {
    header('Location: index.php?p='.$nbPages);
}

$articles = getArticles($link, null, ($currentPage-1)*$perPage, $perPage);

include __DIR__.'/template/articles.php';

require __DIR__.'/_footer.php';
