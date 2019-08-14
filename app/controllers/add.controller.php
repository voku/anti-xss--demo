<?php

// POST / GET routes

use app\models\Xss;

$app->post(
    '/add',
    static function () use ($app) {

        //
        // XSS -> DB
        //

        $data['post'] = $_POST['xss'];
        $data['msg_error'] = false;
        $newXss = new Xss();

        if (empty(\trim($data['post']['xss']))) {
            $data['error']['xss'] = ' has-error ';
            $data['msg_error'] = 'Please try to add a XSS-String.';
        }

        if (empty(\trim($data['post']['author']))) {
            $data['error']['author'] = ' has-error ';
            $data['msg_error'] = 'Please add a author.';
        }

        if ($data['msg_error'] === false) {

            $newXss->xss = $data['post']['xss'];
            $newXss->desc = $data['post']['desc'];
            $newXss->keywords = $data['post']['keywords'];
            $newXss->author = $data['post']['author'];

            $saved = $newXss->insert();

            $data['msg_success'] = 'Successful added...';

            if ($saved) {
                \header('Location: /?msg_success=1');
            }
        }

        $app->render('tpl_index.twig', ['page_template' => 'tpl_index', 'page_id' => 2, 'data' => $data]);
    }
)->name('add');
