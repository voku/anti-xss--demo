<?php

/**
 * Created by PhpStorm.
 * User: menadwork-user
 * Date: 04.11.2014
 * Time: 01:25
 */

class ExmapleTest extends PHPUnit_Framework_TestCase
{

  /**
   * @var Model_Ticket
   */
  public $tickets;

  /**
   * test if we get a array from db
   */
  public function testArray()
  {
    $data = $this->tickets->getAll();

    $this->assertNotEmpty($data);
    $this->assertEquals('lmoelleken@menadwork.com', $data[0]['email']);
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->tickets = new Model_Ticket();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

}
