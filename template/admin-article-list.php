<?php include __DIR__.'/_header.php'; ?>

<h1>Administration: List Articles <a class="btn btn-primary" href="/admin-article-add.php">Add <span class="glyphicon glyphicon-plus-sign"></span></a></h1>

<table class="table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Content</th>
        <th>Image</th>
        <th>CreatedAt</th>
        <th>Enabled</th>
        <th>Activate</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($articles as $article) { ?>
        <tr>
            <td><a href="../article.php?id=<?php echo  $article['id']; ?>" target="_blank"><?php echo $article['id'];?></a></td>
            <td><?php echo getExcerpt($article['title'], 30);?></td>
            <td><?php echo getExcerpt($article['content'], 100);?></td>
            <td><img src="<?php echo $article['image'];?>" alt="<?php $article['title'];?>" width="50" height="35"></td>
            <td><?php echo $article['created_at'];?></td>
            <?php if ($article['enabled'] == true) { ?>
                <td><span class="label label-success">enabled</span></td>
                <td><a href="admin-article-activate.php?id=<?php echo $article['id'];?>&activate=false">Deactivate</a></td>
            <?php } else { ?>
                <td><span class="label label-danger">disabled</span></td>
                <td><a href="admin-article-activate.php?id=<?php echo $article['id'];?>&activate=1">Activate</a></td>
            <?php } ?>
            <td><a href="admin-article-edit.php?id=<?php echo $article['id'];?>">Edit</a></td>
            <td><a href="admin-article-delete.php?id=<?php echo $article['id'];?>">Delete</a></td>
        </tr>
    <?php } ?>

    </tbody>
</table>

<?php include __DIR__.'/_footer.php'; ?>