<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateLinksTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_links()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/api/shorten', factory(Link::class)->raw());

        $response->assertStatus(200);

        $response = $response->decodeResponseJson();

        $this->assertDatabaseHas('links', [
            'id' => $response['id'],
            'original' => $response['original']
        ]);
    }

    public function test_it_returns_correct_json()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/api/shorten', factory(Link::class)->raw());

        $link = Link::find($response->decodeResponseJson()['id']);

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $link->id,
            'original' => $link->original,
            'short' => $link->short(),
        ]);
    }

    public function test_it_validates_input_for_creation()
    {
        $this->actingAs(factory(User::class)->create());

        $link = factory(Link::class)->raw([
            'original' => '',
        ]);

        $this->json('POST', '/api/shorten', $link)
            ->assertJsonValidationErrors('original');

        $link = factory(Link::class)->raw([
            'original' => 'Hello there! I am not a link.',
        ]);

        $this->json('POST', '/api/shorten', $link)
            ->assertJsonValidationErrors('original');
    }

    public function test_can_view_the_link_creation_page()
    {
        $this->get('/links')
            ->assertStatus(200);
    }
}
