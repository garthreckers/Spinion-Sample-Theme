<?php
// Composer
require_once('vendor/autoload.php');

(new Spinion\Spin())
    ->wpRemoveJunk()
    ->start();

