<?php

// POST / GET routes

use app\models\Xss;

$app->get(
    '/',
    static function () use ($app) {
        $data['xss'] = (new Xss())->limit(0, 100)->fetchAll();

        if ($_GET['msg_success'] == 1) {
            $data['msg_success'] = 'Your XSS-String was filtered, take a look ...';
        }

        $app->render('tpl_index.twig', ['page_template' => 'tpl_index', 'page_id' => 1, 'data' => $data]);
    }
)->name('home');
