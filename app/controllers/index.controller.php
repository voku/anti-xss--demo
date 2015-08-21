<?php

// POST / GET routes

$app->get(
    '/', function () use ($app) {

  $xss = new Model_Xss();
  $data['xss'] = $xss->getAll();

  if ($_GET['msg_success'] == 1) {
    $data['msg_success'] = 'Your XSS-String was filtered, take a look ...';
  }

  $app->render('tpl_index.twig', array('page_template' => 'tpl_index', 'page_id' => 1, 'data' => $data));
}
)->name('home');
