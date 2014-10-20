<?php include __DIR__.'/_header.php'; ?>

    <h1>Contact</h1>

    <?php
    if (isset($missing_credential)) {
    ?>
    <div class="alert alert-warning fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <strong>Warning!</strong> At least one field is empty, all fields are required.
    </div>
    <?php
    }
    ?>

    <?php
    if (isset($send_successfully)) {
    ?>
    <div class="alert alert-success fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <strong>Success!</strong> Information successfully send to the webmaster.
    </div>
    <?php
    }
    ?>

    <?php
    if (isset($send_error)) {
    ?>
    <div class="alert alert-danger fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <strong>Error!</strong> Error with mail() function, the website is probably on localhost.
    </div>
    <?php
    }
    ?>

    <form id="contactForm" role="form" method="post">
        <label for="name">Name: </label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>

        <label for="email">Email: </label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>

        <label for="message">Message: </label>
        <textarea name="message" class="form-control" id="message" cols="30" rows="10" required placeholder="Message"></textarea>

        <button type="submit" class="btn btn-default" name="contactSubmit">Contact webmaster</button>
    </form>

<?php include __DIR__.'/_footer.php'; ?>