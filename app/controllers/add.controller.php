<?php

// POST / GET routes

$app->post(
    '/add', function () use ($app) {

  //
  // DB -> XSS
  //

  $xss = new Model_Xss();
  $data['xss'] = $xss->getAll();

  //
  // XSS -> DB
  //

  $data['post'] = $_POST['xss'];
  $data['msg_error'] = false;
  $newXss = new Model_Xss();

  if (empty(trim($data['post']['xss']))) {
    $data['error']['xss'] = ' has-error ';
    $data['msg_error'] = 'Please try to add a XSS-String.';
  }

  if (empty(trim($data['post']['author']))) {
    $data['error']['author'] = ' has-error ';
    $data['msg_error'] = 'Please add a author.';
  }

  if ($data['msg_error'] === false) {
    $saved = $newXss->save();
    $data['msg_success'] = 'Successful added...';

    if ($saved) {
      header('Location: /?msg_success=1');
    }
  }

  $app->render('tpl_index.twig', array('page_template' => 'tpl_index', 'page_id' => 2, 'data' => $data));
}
)->name('add');
