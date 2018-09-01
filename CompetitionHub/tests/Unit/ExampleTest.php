<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
   
    
    public function testSomethingIsTrue()
    {
        $this->assertTrue(true);
    }


    public function testUserRouteTest()
    {
      $response = $this->call('GET', 'user/profile');
      $response = $this->call($method, $uri, $parameters, $cookies, $files, $server, $content);

      $this->assertEquals('Personal Information', $response->getContent());
    }

    public function testViewDataTest()
    {
        $this->call('GET', '/');

        $this->assertViewHas('name');
    }
    
    public function testSessionDataTest()
    {
        $this->call('GET', '/');

        $this->assertSessionHas('name');
    }


}
