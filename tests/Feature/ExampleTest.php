<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Laravel Homestead 2');

    }

    public function testVezba(){
        //Poseti home page
        $this->get('/');
        //Klikni na 'Click me
        $this->click("Klikni me");
        //Vidi "klinuo si me"
        //Proveri da li je url '/feedback'
    }
}
