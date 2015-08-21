<?php

/**
 * Object model mapping for relational table `xss`
 */
class Model_Xss extends Model_Base
{

  /**
   * save the
   *
   * @return int|string
   * @throws \RedBeanPHP\RedException
   */
  public function save()
  {
    $xssPost = $_POST['xss'];

    $xss = R::dispense('xss');
    $xss->xss = $xssPost['xss'];
    $xss->source = $xssPost['source'];
    $xss->desc = $xssPost['desc'];
    $xss->keywords = $xssPost['keywords'];
    $xss->author = $xssPost['author'];
    return R::store($xss);
  }

  /**
   * get all
   *
   * @param bool $isBean
   *
   * @return array
   */
  public function getAll($isBean = false)
  {
    if ($isBean !== false) {
      $return = R::findAll('xss');
    } else {
      $return = R::getAll('SELECT * FROM xss');
    }

    return $return;
  }

  /**
   * lifecycle hooks
   */
  public function dispense()
  {
    parent::dispense();
    $this->bean->role = $this->beanType;
  }

}
