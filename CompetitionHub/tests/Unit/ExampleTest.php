<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
// test true
class ExampleTest extends TestCase
{
   
    
    public function testSomethingIsTrue()
    {
        $this->assertTrue(true);
    }

   // test Home
    public function testHome()
   {
        $response = $this->get('/');

        $response->assertSee('Welcome to CompetitionHub!');
    }
 // test Catagory
    public function testCatagory()
    {
        $response = $this->get('/catagory');
        $response->assertStatus(200);
    }
 // test competition
    public function testCompetition()
    {
        $response = $this->get('/competitions');
        $response->assertSee('Top Competitions', 'Top Catagories & Competitions');
    }
 // test user
    public function testUser()
    {
        $this->actingAs($user);
        $this->assertTrue(true);
    }
}
