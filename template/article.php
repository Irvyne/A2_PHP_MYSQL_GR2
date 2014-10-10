<?php include __DIR__.'/_header.php'; ?>

    <h1>Mon article</h1>

<?php
    echo '<article>';
        echo '<h1>'.$article['title'].'</h1>';
        echo '<p>'.$article['content'].'</p>';
    echo '</article>';
?>

<?php include __DIR__.'/_footer.php'; ?>