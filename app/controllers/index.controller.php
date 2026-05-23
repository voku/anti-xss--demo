<?php

declare(strict_types=1);

use app\models\Xss;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get(
    '/',
    static function (Request $request, Response $response) use ($twig): Response {
        $data = [
            'xss' => (new Xss())->limit(0, 100)->orderBy('id DESC')->fetchAll(),
        ];

        if ((int) ($request->getQueryParams()['msg_success'] ?? 0) === 1) {
            $data['msg_success'] = 'Your XSS string was filtered — take a look.';
        }

        return $twig->render($response, 'tpl_index.twig', ['page_template' => 'tpl_index', 'page_id' => 1, 'data' => $data]);
    }
);
