<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header-admin.php';

$tags = getTags($link);

include __DIR__.'/template/admin-tag-list.php';

require __DIR__.'/_footer.php';
