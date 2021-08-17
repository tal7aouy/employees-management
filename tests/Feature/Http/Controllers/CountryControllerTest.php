<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Constraint\Count;
use Tests\TestCase;

class CountryControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_get_country_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/countries');
        $response->assertOk();
    }
    public function test_create_country_item()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/countries', [
            'name' => 'Morocco',
            'country_code' => 122
        ]);
        $this->assertCount(1, Country::all());
        $response->assertRedirect();

    }

    public function test_country_can_be_update()
    {
        $this->withoutExceptionHandling();
        // connect as a user
        $user = User::factory()->create();
        $this->actingAs($user);
        // create country
        $this->post('/countries', [
            'name' => 'Morocco',
            'country_code' => 123
        ]);
        $country = Country::first();
        $response = $this->patch(
            "/countries/{$country->id}",
            [
                'name' => 'USA',
                'country_code' => 1234
            ]
        );
        $this->assertEquals('USA', Country::first()->name);
        $this->assertEquals(1234, Country::first()->country_code);
        $response->assertRedirect();
    }
    public function test_can_delete_country()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        // create post
        $this->post(
            '/countries',
            [
                'name' => 'Canada',
                'country_code' => 20000
            ]
        );
        $country = Country::first();
        $this->assertCount(1, Country::all());
        $response = $this->delete("/countries/{$country->id}");
        $this->assertCount(0, Country::all());
        $response->assertRedirect();
    }
}
