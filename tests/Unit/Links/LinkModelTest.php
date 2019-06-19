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

    public function test_it_returns_clicks_by_month()
    {
        $link = factory(Link::class)->create();

        for ($i = 0; $i < 3; $i++) {
            $link->addClick(new Carbon('first day of January 2019'));
        }

        for ($i = 0; $i < 5; $i++) {
            $link->addClick(new Carbon('first day of March 2019'));
        }

        $link->addClick(new Carbon('first day of December 2019'));

        $this->assertEquals([3, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 1], $link->clicks_by_month);
    }
}
