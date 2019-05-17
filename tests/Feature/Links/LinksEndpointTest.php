<?php

namespace Tests\Feature;

use App\Link;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinksEndpointTest extends TestCase
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

    public function test_it_redirects_a_short_link()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/api/shorten', factory(Link::class)->raw());

        $link = Link::find($response->decodeResponseJson()['id']);

        $this->get('/' . $link->short())
            ->assertRedirect($link->original);
    }

    public function test_it_returns_correct_json_when_not_logged_in()
    {
        $response = $this->json('POST', '/api/shorten', factory(Link::class)->raw());

        $response->assertJson([
            'message' => 'Unauthenticated.'
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

    public function test_a_link_requires_an_owner()
    {
        $link = factory(Link::class)->raw();
        $this->post('/api/shorten', $link)
            ->assertRedirect('login');
    }
}
