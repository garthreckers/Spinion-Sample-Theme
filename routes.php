<?php

(new Spinion\Route)->url('old-page')
    ->redirect('/new-page');

(new Spinion\Route)->url('custom-page/:id')
    ->controller('Controllers\Custom@showPage')
    ->call();

(new Spinion\Route)->url('custom-page/:id')
    ->methods(array('GET', 'POST'))
    ->controller('Controllers\Custom@showPage')
    ->call();

(new Spinion\Route)->url('sign-up')
    ->methods(array('GET'))
    ->controller('Controllers\Custom@showPage')
    ->call();

(new Spinion\Route)->url('sign-up')
    ->methods(array('POST'))
    ->controller('Controllers\Custom@processSignup')
    ->call();

(new Spinion\Route)->url('custom-page/:id')
    ->closure(function () {
        // Some function code
    });