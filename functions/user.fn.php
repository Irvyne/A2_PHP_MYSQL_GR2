<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

/**
 * @param $link
 *
 * @return array
 */
function getUsers($link)
{
    $sql = 'SELECT * FROM users';
    $result = mysqli_query($link, $sql);

    $categories = [];
    while ($category = mysqli_fetch_assoc($result)) {
        $categories[] = $category;
    }

    return $categories;
}

/**
 * @param $link
 * @param $id
 *
 * @return array|null
 */
function getUser($link, $id)
{
    $sql    = 'SELECT * FROM users WHERE id='.mysqli_real_escape_string($link, $id);
    $result = mysqli_query($link, $sql);

    return mysqli_fetch_assoc($result);
}

/**
 * @param $link
 * @param $username
 * @param $password
 * @param $role
 *
 * @return bool
 */
function addUser($link, $username, $password, $role)
{
    $sql     = 'INSERT INTO users (id, username, password, role) VALUES (NULL, ?, ?, ?)';
    $prepare = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($prepare, 'sss', $username, sha1($password), $role);
    $result = mysqli_stmt_execute($prepare);

    return $result;
}

/**
 * @param       $link
 * @param       $id
 * @param array $update
 *
 * @return bool|mysqli_result
 */
function updateUser($link, $id, array $update)
{
    $sql = 'UPDATE users SET ';

    $i = 0;
    foreach ($update as $column => $value) {
        if ($i > 0) {
            $sql .= ', ';
        }
        $sql .= $column.'=';
        if (is_string($value)) {
            $sql .= '"';
        }
        $sql .= mysqli_real_escape_string($link, $value);
        if (is_string($value)) {
            $sql .= '"';
        }
        $i++;
    }

    $sql .= ' WHERE id='.mysqli_real_escape_string($link, $id);

    return mysqli_query($link, $sql);
}

/**
 * @param $link
 * @param $id
 *
 * @return bool|mysqli_result
 */
function removeUser($link, $id)
{
    $sql = 'DELETE FROM users WHERE id='.mysqli_real_escape_string($link, $id);
    $result = mysqli_query($link, $sql);

    return $result;
}

/**
 * @param $link
 * @param $username
 * @param $password
 * @return bool
 */
function connection($link, $username, $password)
{
    $username = mysqli_real_escape_string($link, $username);
    $password = sha1(mysqli_real_escape_string($link, $password));

    $sql = 'SELECT username, role FROM users WHERE username="'.$username.'" AND password="'.$password.'"';
    $result = mysqli_query($link, $sql);
    $user = mysqli_fetch_assoc($result);

    if(sizeof($user) >= 1) {
        addSession($user);

        return true;
    } else {
        return false;
    }
}

/**
 * @param array $user
 *
 * @return bool
 */
function addSession(array $user)
{
    $_SESSION['status'] = 'connected';
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    return true;
}

/**
 * @return array
 */
function getSession()
{
    return [
        'connected' => !empty($_SESSION['status']) ? $_SESSION['status'] : null,
        'username'  => !empty($_SESSION['username']) ? $_SESSION['username'] : null,
        'role'      => !empty($_SESSION['role']) ? $_SESSION['role'] : null,
    ];
}

/**
 * @return bool
 */
function isAdmin()
{
    if (isConnected()) {
        if (!empty($_SESSION['status']) && 'connected' === $_SESSION['status'] && !empty($_SESSION['role']) && 'ROLE_ADMIN' === $_SESSION['role']) {
            return true;
        }
    }
    return false;
}

/**
 * @return bool
 */
function isConnected()
{
    if (!empty($_SESSION['status']) && $_SESSION['status'] == 'connected') {
        return true;
    } else {
        return false;
    }
}