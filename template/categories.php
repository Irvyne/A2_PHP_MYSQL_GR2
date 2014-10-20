<?php include __DIR__.'/_header.php'; ?>

<?php
$i = 0;
foreach ($categories as $category) {
    if (0 === $i%3)
        echo '<div class="row">';

    echo '<article class="col-xs-12 col-sm-6 col-md-4 col-lg-4">';
        echo '<h1><a href="/category.php?id='.$category['id'].'">'.$category['name'].'</a></h1>';
        echo '<img title="'.$category['name'].'" alt="'.$category['name'].'" src="'.$category['image'].'">';
    echo '</article>';

    if (2 === $i%3)
        echo '</div>';
    $i++;
}
?>

<?php include __DIR__.'/_footer.php'; ?>