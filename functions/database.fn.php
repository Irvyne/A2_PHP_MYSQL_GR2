<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

function getDatabaseLink(array $config) {
    return mysqli_connect(
        $config['hostname'],
        $config['username'],
        $config['password'],
        $config['dbname']
    );
}

function closeDatabaseLink($link) {
    return mysqli_close($link);
}
