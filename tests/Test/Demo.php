<?php
namespace Test;

class Demo extends \PHPUnit_Framework_TestCase
{
    public function testCanAccessApp()
    {
        // Create an instance of a form class. No need to include, just reference it.
        $test = new \Application\Classes\Test();
        $this->assertEquals(42, $test->getTestValue());
    }
}