<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Migrations\Migration;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    public function testBasicTest()
    {
        $this->markTestSkipped('preskocen test.');
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Laravel Homestead 2');

    }


}
