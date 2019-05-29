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

        auth()->user()->links()->create(factory(Link::class, 10)->raw());

        $response = $this->json('GET', '/api/' . auth()->id() . '/links');

        $response->assertStatus(200);

        dd($response->content());
    }
}
