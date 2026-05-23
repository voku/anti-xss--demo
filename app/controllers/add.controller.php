<?php

declare(strict_types=1);

use app\models\Xss;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post(
    '/add',
    static function (Request $request, Response $response) use ($twig): Response {
        $payload = $request->getParsedBody();
        $post = [];

        if (\is_array($payload) && \is_array($payload['xss'] ?? null)) {
            $post = $payload['xss'];
        }

        $data = [
            'post'      => $post,
            'msg_error' => false,
        ];

        $newXss = new Xss();
        $xssValue = \trim((string) ($post['xss'] ?? ''));
        $authorValue = \trim((string) ($post['author'] ?? ''));
        $captchaValue = (int) ($post['captcha'] ?? 0);

        if ($xssValue === '') {
            $data['error']['xss'] = ' has-error ';
            $data['msg_error'] = 'Please try to add an XSS string.';
        }

        if ($authorValue === '') {
            $data['error']['author'] = ' has-error ';
            $data['msg_error'] = 'Please add an author.';
        }

        if ($captchaValue !== 4) {
            $data['error']['captcha'] = ' has-error ';
            $data['msg_error'] = 'Please add the correct answer.';
        }

        if ($data['msg_error'] === false) {
            $newXss->xss = $xssValue;
            $newXss->desc = (string) ($post['desc'] ?? '');
            $newXss->keywords = (string) ($post['keywords'] ?? '');
            $newXss->author = $authorValue;

            if ($newXss->insert()) {
                return $response
                    ->withHeader('Location', '/?msg_success=1')
                    ->withStatus(302);
            }

            $data['msg_error'] = 'Saving failed, please try again.';
        }

        return $twig->render($response, 'tpl_index.twig', ['page_template' => 'tpl_index', 'page_id' => 2, 'data' => $data]);
    }
);
