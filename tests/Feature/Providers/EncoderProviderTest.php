<?php

namespace Tests\Feature;

use App\Link;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EncoderProviderTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_be_constructed()
    {
        $this->assertInstanceOf(Hashids::class, $this->app->encoder);
    }

    /**
     * Test that a link's id can be encoded to a unique string.
     *
     * @return void
     */
    public function test_a_link_can_be_encoded()
    {
        $link = factory(Link::class)->create();

        $encodedId = app()->encoder->encode($link->id);

        $this->assertEquals(app()->encoder->decode($encodedId)[0], $link->id);
    }
}
