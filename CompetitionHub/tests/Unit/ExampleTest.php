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
        
    */


    public function test_Displays_Home_Page()
    {
      $response = $this->call('GET','/');

      $this->assertTrue(strpos($response-> getContent(),'CompetitionHub') !== false);
    }


}
