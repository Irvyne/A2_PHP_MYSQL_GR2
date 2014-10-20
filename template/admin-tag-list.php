<?php include __DIR__.'/_header.php'; ?>

    <h1>Administration: List Tags <a class="btn btn-primary" href="/admin-tag-add.php">Add <span class="glyphicon glyphicon-plus-sign"></span></a></h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($tags as $tag) { ?>
            <tr>
                <td><a href="../article.php?id=<?php echo  $tag['id']; ?>" target="_blank"><?php echo $tag['id'];?></a></td>
                <td><?php echo getExcerpt($tag['name'], 30);?></td>
                <td><a href="admin-tag-edit.php?id=<?php echo $tag['id'];?>">Edit</a></td>
                <td><a href="admin-tag-delete.php?id=<?php echo $tag['id'];?>">Delete</a></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

<?php include __DIR__.'/_footer.php'; ?>