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

    public function testHome()
    {
        $response = $this->get('/');

        $response->assertSee('Welcome to CompetitionHub!');
    }

    public function testCatagory()
    {
        $response = $this->get('/catagory');

        $response->assertStatus(200);
    }

    public function testCompetition()
    {
        $response = $this->get('/competitions');

        $response->assertSee('Top Competitions', 'Top Catagories & Competitions');
        
    }
    public function testUser()
    {
        $this->actingAs($user);

        $this->assertTrue(true);

    }









}
