<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{

    public function testHomePageIsWorkingCorrectly(): void
    {
        $response = $this->get('/');

        $response->assertSeeText('Home');
        $response->assertSeeText('Welcome');
    }

    public function testContactPageIsWorkingCorrectly(): void
    {
        $response = $this->get('/contact');
        $response->assertSeeText('Contact');
    }
}
