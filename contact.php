<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header.php';

if (isset($_POST['contactSubmit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Test si les champs sont remplis
    if (empty($name) || empty($email) || empty($message)) {
        $missing_credential = true;
    } else {
        if (@mail('irvyne.contact@gmail.com', 'Blog A2 - Send by '.$email, $message)) {
            $send_successfully = true;
        } else {
            $send_error = true;
        }
    }
}

require __DIR__.'/_footer.php';

include __DIR__.'/template/contact.php';