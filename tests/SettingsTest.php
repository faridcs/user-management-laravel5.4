<?php

namespace Tests;

use App\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SettingsTest extends TestCase
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

    public function testSettingPage()
    {

        $this->actingAs($this->user())
            ->get(route('general-settings'))
            ->assertDontSee('Whoops')
            ->assertSee('settings')
            ->assertDontSee('Sorry')
            ->assertDontSee('Woops');

        $this->actingAs($this->user())
            ->get(route('social-settings'))
            ->assertDontSee('Whoops')
            ->assertSee('settings')
            ->assertDontSee('Sorry')
            ->assertDontSee('Woops');
    }

    public function testSettingEdit()
    {

    }

}
