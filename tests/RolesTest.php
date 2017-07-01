<?php

namespace Tests;

use App\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RolesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testRolesIndexPage()
    {

        $this->actingAs($this->user())
            ->get(route('user.roles.index'))
            ->assertDontSee('Whoops')
            ->assertSee('role')
            ->assertDontSee('Sorry');
    }

    public function testRoleEdit()
    {
        $this->actingAs($this->user())
            ->get(route('user.roles.edit', $this->role()->id))
            ->assertDontSee('Whoops')
            ->assertSee('input')
            ->assertDontSee('Sorry');


        // Missing fields
        $this->actingAs($this->user())
            ->put(route('user.roles.update', $this->user()->id),
                [
                    'name'          => '',
                    'display_name'  => '',
                    'description'   => '',
                    'permission'   => '',
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('fail');

        // Some field filled

        $this->actingAs($this->user())
            ->put(route('user.roles.update', $this->user()->id),
                [
                    'name'     => $this->role()->name,
                    'display_name'    => '',
                    'description' => $this->role()->description,
                    'permission['.$this->permission()->id.']' => $this->permission()->id,
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('fail');


        // Some field filled
        $this->actingAs($this->user())
            ->put(route('user.roles.update', $this->role()->id),
                [
                    'name'          => 'Test',
                    'display_name'  => 'Test',
                    'description'   => 'Its a test',
                    'permission' => [$this->permission()->id => $this->permission()->id],
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('success');

    }

    // Destroy role

    public function testRoleDelete()
    {

        // Missing fields
        $this->actingAs($this->user())
            ->delete(route('user.roles.destroy', $this->role()->id),
                [
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('success');


    }

}
