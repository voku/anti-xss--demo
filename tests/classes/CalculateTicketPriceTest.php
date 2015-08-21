<?php
use MyApp\Helper\CalculateTicketPrice;

/**
 * Created by PhpStorm.
 * User: menadwork-user
 * Date: 04.11.2014
 * Time: 01:40
 */

class CalculateTicketPriceTest extends PHPUnit_Framework_TestCase {

  /**
   * @var CalculateTicketPrice
   */
  protected $calc;

  public function __construct()
  {
    $this->calc = new CalculateTicketPrice();
  }

  public function testAdd()
  {

    $this->calc->add(1);
    $this->calc->add(2);

    $this->assertEquals(15, $this->calc->getPrice());
  }
}
