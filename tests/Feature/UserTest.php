<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/auth/register');

        $response->assertStatus(200);
    }

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/auth/login');

        $response->assertStatus(200);
    }
}
