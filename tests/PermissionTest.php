<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionTest extends TestCase
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

    public function testPermissionIndexPage()
    {

        $this->actingAs($this->user())
            ->get(route('user.permissions.index'))
            ->assertDontSee('Whoops')
            ->assertSee('permission')
            ->assertDontSee('Sorry');
    }

    public function testPermissionEdit()
    {
        $this->actingAs($this->user())
            ->get(route('user.permissions.edit', $this->permission()->id))
            ->assertDontSee('Whoops')
            ->assertSee('input')
            ->assertDontSee('Sorry');


        // Missing fields
        $this->actingAs($this->user())
            ->put(route('user.permissions.update', $this->user()->id),
                [
                    'name'          => '',
                    'display_name'  => '',
                    'description'   => '',
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('fail');

        // Some field filled
        $this->actingAs($this->user())
            ->put(route('user.permissions.update', $this->user()->id),
                [
                    'name'     => $this->permission()->name,
                    'display_name'    => '',
                    'description' => $this->permission()->description,
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('fail');


        // Some field filled
        $this->actingAs($this->user())
            ->put(route('user.permissions.update', $this->permission()->id),
                [
                    'name'          => 'Test',
                    'display_name'  => 'Test',
                    'description'   => 'Its a test',
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('success');


    }

    // Destroy role

    public function testPermissionDelete()
    {

        // Missing fields
        $this->actingAs($this->user())
            ->delete(route('user.permissions.destroy', $this->permission()->id),
                [
                ],
                [
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
            ->assertDontSee('Whoops')
            ->assertSee('success');

    }

}
