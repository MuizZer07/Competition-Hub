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

    public function testUserName(){
        $this->user->setName('Muiz');

        $this->assertEquals($this->user->getName(), 'Muiz');
    }
}
