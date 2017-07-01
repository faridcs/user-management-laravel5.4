<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
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

    public function testUserIndexPage()
    {

        $this->actingAs($this->user())
            ->get(route('user.users.index'))
            ->assertDontSee('Whoops')
            ->assertSee('users')
            ->assertDontSee('Sorry');
    }

    public function testUserCreate()
    {

        $this->actingAs($this->user())
            ->get(route('user.users.create'))
            ->assertDontSee('Whoops')
            ->assertSee('input')
            ->assertDontSee('Sorry');
        // Missing fields
        $this->actingAs($this->user())
            ->post(route('user.users.store'),
                ['name'     => '',
                 'email'    => '',
                 'password' => '',
                 'dob'      => '',
                 'gender'   => '',
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('fail');

        // Some field filled
        $this->actingAs($this->user())
            ->post(route('user.users.store'),
                ['name'     => '',
                 'email'    => 'test@test.com',
                 'password' => '1122323',
                 'dob'      => '2016-09-01',
                 'gender'   => '',
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('fail');

        // Some field filled
        $this->actingAs($this->user())
            ->post(route('user.users.store'),
                ['name'     => 'new',
                 'email'    => 'test1@test.com',
                 'password' => '1122323',
                 'dob'      => '2016-09-01',
                 'gender'   => 'male',
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('success');

    }

    public function testUserEdit()
    {

        $this->actingAs($this->user())
            ->get(route('user.users.edit', $this->user()->id))
            ->assertDontSee('Whoops')
            ->assertSee('input')
            ->assertDontSee('Sorry');
        // Missing fields

        $this->actingAs($this->user())
            ->put(route('user.users.update', $this->user()->id),
                ['name'     => '',
                 'email'    => '',
                 'password' => '',
                 'dob'      => '',
                 'gender'   => '',
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('fail');

        // Some field filled
        $this->actingAs($this->user())
            ->put(route('user.users.update', $this->user()->id),
                ['name'     => '',
                 'email'    => 'test@test.com',
                 'password' => '1122323',
                 'dob'      => '2016-09-01',
                 'gender'   => '',
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('fail');

        // Some field filled
        $this->actingAs($this->user())
            ->put(route('user.users.update', $this->user()->id),
                ['id'       => $this->user()->id,
                 'name'     => 'new',
                 'email'    => 'test1@test.com',
                 'password' => '1122323',
                 'dob'      => \Carbon\Carbon::now(),
                 'gender'   => 'male',
                 'status'   => 'active'
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('success');

    }

    public function testUserDelete()
    {


        // Missing fields
        $this->actingAs($this->user())
            ->delete(route('user.users.destroy', $this->user()->id),
                [

                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('success');


    }

}
