<?php
namespace Tests;

use Tests\TestCase;

class DashboardTest extends TestCase
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

    public function testDashboardIndexPage()
    {
        $this->actingAs($this->user())
            ->get(route('user.dashboard.index'))
            ->assertDontSee('Whoops')
            ->assertSee('user')
            ->assertDontSee('Sorry');
    }

}
