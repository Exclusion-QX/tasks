<?php

return array(

    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',

    'task/create' => 'task/create',

    'task/edit/([0-9]+)' => 'task/edit/$1',

    'sort-([a-z]+)/page-([0-9]+)' => 'task/index/$1/$2',
    'page-([0-9]+)/sort-([a-z]+)' => 'task/index/$2/$1',

    'sort-([a-z]+)' => 'task/index/$1/1',
    'page-([0-9]+)' => 'task/index/nameasc/$1',


    '' => 'task/index/id/1', // actionIndex in SiteController


);