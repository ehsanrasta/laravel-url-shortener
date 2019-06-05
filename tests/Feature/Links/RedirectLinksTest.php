<?php

namespace Tests\Feature;

use App\Link;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RedirectLinksTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_redirects_a_short_link()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/api/shorten', factory(Link::class)->raw());

        $link = Link::find($response->decodeResponseJson()['id']);

        $this->get('/' . $link->short)
            ->assertRedirect($link->original);
    }
}
