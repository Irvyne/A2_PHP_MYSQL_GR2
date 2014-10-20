<?php include __DIR__.'/_header.php'; ?>

<?php
$i = 0;
foreach ($tags as $tag) {
    if (0 === $i%3)
        echo '<div class="row">';

    echo '<article class="col-xs-12 col-sm-6 col-md-4 col-lg-4">';
        echo '<h1><a class="label label-primary" href="/tag.php?id='.$tag['id'].'">'.$tag['name'].'</a></h1>';
    echo '</article>';

    if (2 === $i%3)
        echo '</div>';
    $i++;
}
?>

<?php include __DIR__.'/_footer.php'; ?>