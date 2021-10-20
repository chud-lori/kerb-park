<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class BayTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_all_bays()
    {
        $response = $this->get('/api/bay/all');
        $response->assertStatus();
    }
}
