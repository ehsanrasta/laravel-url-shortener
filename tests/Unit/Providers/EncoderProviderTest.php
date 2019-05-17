<?php

namespace Tests\Unit;

use Hashids\Hashids;
use Illuminate\Support\ServiceProvider;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EncoderProviderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_can_be_constructed()
    {
        $this->assertInstanceOf(Hashids::class, $this->app->encoder);
    }
}
