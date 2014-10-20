<?php include __DIR__.'/_header.php'; ?>

    <h1>Administration: List Users <a class="btn btn-primary" href="/admin-user-add.php">Add <span class="glyphicon glyphicon-plus-sign"></span></a></h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($users as $user) { ?>
            <tr>
                <td><a href="../article.php?id=<?php echo  $user['id']; ?>" target="_blank"><?php echo $user['id'];?></a></td>
                <td><?php echo $user['username'];?></td>
                <td><?php echo ('ROLE_ADMIN' === $user['role']) ? '<span class="label label-primary">Admin</span>' : '<span class="label label-default">Default</span>';?></td>
                <td><a href="admin-user-edit.php?id=<?php echo $user['id'];?>">Edit</a></td>
                <td><a href="admin-user-delete.php?id=<?php echo $user['id'];?>">Delete</a></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

<?php include __DIR__.'/_footer.php'; ?>