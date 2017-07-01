<?php
namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    // Index
    
    public function testIndex()
    {
        // Check if Login Page is visible or not
        $this->get('/')
            ->assertDontSee('Whoops')
            ->assertDontSee('Sorry');

        $this->get('/')
            ->assertSee('Login')
            ->assertDontSee('Whoops');
    }

    public function testAuth()
    {

        // Input Field Blank
        $postUrl = route('user.login_check');
        $this->post($postUrl,
            [
                'email'    => '',
                'password' => '',
                '_token' => csrf_token()
            ],
            [
                'X-Requested-With' => 'XMLHttpRequest'
            ])
            ->assertDontSee('Whoops')
            ->assertSee('fail');


        // Wrong Login Details
        $this->post($postUrl,
            [
                'email'    => 'ajaysdfadfsafd',
                'password' => '123456',
            ],
            ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertDontSee('success')
            ->assertDontSee('Whoops')
            ->assertDontSee('Sorry');

        $this->post($postUrl,
            [
                'email'    => $this->user()->email,
                'password' => '123456',
            ],
            ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertDontSee('Whoops')
            ->assertSee('success')
            ->assertDontSee('Sorry');
    }

}
