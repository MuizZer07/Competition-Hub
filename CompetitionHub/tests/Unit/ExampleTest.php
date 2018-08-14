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


    public function UserRouteTest()
    {
      $response = $this->call('GET', 'user/profile');
      $response = $this->call($method, $uri, $parameters, $cookies, $files, $server, $content);

      $this->assertEquals('Personal Information', $response->getContent());
    }

    public function ViewDataTest()
    {
        $this->call('GET', '/');

        $this->assertViewHas('name');
    }
    
    public function SessionDataTest()
    {
        $this->call('GET', '/');

        $this->assertSessionHas('name');
    }


}
