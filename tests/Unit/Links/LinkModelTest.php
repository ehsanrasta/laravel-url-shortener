<?php

namespace Tests\Unit;

use App\Link;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_user()
    {
        $this->actingAs(factory(User::class)->create());

        $link = factory(Link::class)->create();

        auth()->user()->links()->save($link);

        $this->assertInstanceOf(User::class, $link->user);
    }
}
