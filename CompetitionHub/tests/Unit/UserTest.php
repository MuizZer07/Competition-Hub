<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    protected $user;
    public function setUp(){
        $this->user = new User;
    }
 //  User Name Test 1
    public function testUserName(){
        $this->user->setName('Muiz');

        $this->assertEquals($this->user->getName(), 'Muiz');
    }
 // User Name Test 2
    public function testUserName2()
    {
        $this->user->setName('Ahad');
        $this->assertEquals($this->user->getName(), 'Ahad');
     }
}
