<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     * @group foo
     */
    public function testBasicExample1()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Homestead')
                ->clickLink('Klikni me')
            ->click('@ClickMee');

        });
    }
}
