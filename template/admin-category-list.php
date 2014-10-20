<?php include __DIR__.'/_header.php'; ?>

<h1>Administration: List Categories <a class="btn btn-primary" href="/admin-category-add.php">Add <span class="glyphicon glyphicon-plus-sign"></span></a></h1>

<table class="table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Image</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($categories as $category) { ?>
        <tr>
            <td><a href="../article.php?id=<?php echo  $category['id']; ?>" target="_blank"><?php echo $category['id'];?></a></td>
            <td><?php echo getExcerpt($category['name'], 30);?></td>
            <td><img src="<?php echo $category['image'];?>" alt="<?php $category['name'];?>" width="50" height="35"></td>
            <td><a href="admin-category-edit.php?id=<?php echo $category['id'];?>">Edit</a></td>
            <td><a href="admin-category-delete.php?id=<?php echo $category['id'];?>">Delete</a></td>
        </tr>
    <?php } ?>

    </tbody>
</table>

<?php include __DIR__.'/_footer.php'; ?>