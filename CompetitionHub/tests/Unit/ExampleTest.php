<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
    
        public function testBasicTest()
        {
            $this->assertTrue(true);
        }*/

    public function test_Displays_Home_Page()
    {
      $this-> call('GET','/');
      $this-> see('Competition'); 
    }

    public function see($text)
    {
        $crawler = $this -> client -> getCrawler();
        $found = $crawler-> filter("body:contains('{$text}')");

        $this-> assertGreaterThan(0,count($found), "Expected To see {$text} in the view");
    }
}
