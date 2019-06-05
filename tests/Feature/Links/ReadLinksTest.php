<?php

namespace Tests\Feature;

use App\Link;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadLinksTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_correct_json()
    {
        $this->actingAs(factory(User::class)->create());

        for ($i = 0; $i < 3; $i++) {
            auth()->user()->links()->create(factory(Link::class)->raw());
        }

        $response = $this->json('GET', '/api/links');

        $response->assertStatus(200)
            ->assertJson(auth()->user()->links()->get()->toArray())
            ->assertJsonStructure([
                '*' => ['created_at', 'original', 'short']
            ]);
    }

    public function test_it_returns_all_links()
    {
        $this->actingAs(factory(User::class)->create());

        for ($i = 0; $i < 3; $i++) {
            auth()->user()->links()->create(factory(Link::class)->raw());
        }

        $response = $this->json('GET', '/api/links');

        $response->assertStatus(200);

        $this->assertEquals(3, sizeof($response->decodeResponseJson()));

        auth()->logout();

        $response = $this->json('GET', '/api/links');

        $response->assertStatus(200);

        $this->assertEquals(0, sizeof($response->decodeResponseJson()));
    }
}
