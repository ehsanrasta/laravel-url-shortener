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

        factory(Link::class, 5)->create([
            'user_id' => auth()->id()
        ]);

        $response = $this->json('GET', '/api/links');

        $response->assertStatus(200)
            ->assertExactJson(auth()->user()->links()->get()->toArray())
            ->assertJsonStructure([
                '*' => ['created_at', 'original', 'short']
            ]);
    }

    public function test_it_returns_all_links()
    {
        $this->actingAs(factory(User::class)->create());

        factory(Link::class, 5)->create([
            'user_id' => auth()->id()
        ]);

        $response = $this->json('GET', '/api/links');

        $response->assertStatus(200);

        $this->assertEquals(5, sizeof($response->decodeResponseJson()));

        auth()->logout();

        $response = $this->json('GET', '/api/links');

        $response->assertStatus(200);

        $this->assertEquals(0, sizeof($response->decodeResponseJson()));
    }

    public function test_it_increments_clicks()
    {
        $link = factory(Link::class)->create();

        $this->assertEquals(0, $link->clicks()->get()->count());

        $this->get('/' . $link->short);

        $link = $link->fresh();

        $this->assertEquals(1, $link->clicks()->get()->count());
    }
}
