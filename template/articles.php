<?php include __DIR__.'/_header.php'; ?>

<?php
$i = 0;
foreach ($articles as $article) {
    if (0 === $i%3)
        echo '<div class="row">';

    echo '<article class="col-xs-12 col-sm-6 col-md-4 col-lg-4">';
        echo '<header>';
            echo '<h1><a href="/article.php?id='.$article['id'].'">'.$article['title'].'</a></h1>';
            echo '<img title="'.$article['title'].'" alt="'.$article['title'].'" src="'.$article['image'].'">';
            echo '<small>Written by '.$article['user_id'].' on '.$article['created_at'].'</small>';
        echo '</header>';
        echo '<div class="content">';
            echo '<p>'.$article['content'].'</p>';
        echo '</div>';
        echo '<footer>';
            echo '<p>Posted in category: <a href="/article?id='.$article['category_id'].'">'.$article['category_id'].'</a></p>';
            echo '<p><a href="/tag?id='.$article['category_id'].'"><span class="label label-primary">Primary</span></a></p>';
        echo '</footer>';
    echo '</article>';

    if (2 === $i%3)
        echo '</div>';
    $i++;
}
?>

<?php if (isset($currentPage)) { ?>
<div id="pagination" class="col-md-12 text-center">
    <ul class="pagination pagination-lg">
        <?php
        $i = 0;
        while ($i <= $lastPage) {
            $currentI = $i+1;

            if (1 === $currentI) {
                if ($currentPage === 1)
                    echo '<li class="disabled"><a href="#">«</a></li>';
                else
                    echo '<li><a href="?p='.($currentPage-1).'">«</a></li>';
            }

            if ($currentI === $currentPage)
                echo '<li class="active"><a href="?p='.$currentI.'">'.$currentI.'</a></li>';
            else
                echo '<li><a href="?p='.$currentI.'">'.$currentI.'</a></li>';

            if ($i === $lastPage) {
                if ($currentPage === ($lastPage+1))
                    echo '<li class="disabled"><a href="#">»</a></li>';
                else
                    echo '<li><a href="?p='.($currentPage+1).'">»</a></li>';
            }

            $i++;
        }
        ?>
    </ul>
</div>
<?php } ?>

<?php include __DIR__.'/_footer.php'; ?>