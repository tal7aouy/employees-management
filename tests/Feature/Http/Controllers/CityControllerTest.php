<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_render_index_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/cities');
        $response->assertOk();
    }
    public function test_can_create_new_city()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        // create a country
        $this->post(
            '/countries',
            [
                'name' => 'Morocco',
                'country_code' => 12333
            ]
        );
        // create state
        $this->post(
            '/states',
            [
                'name' => 'South Africa',
                'country_id' => Country::first()->id
            ]
        );

        // create city
        $response = $this->post(
            '/cities',
            [
                'name' => 'Casablanca',
                'state_id' => State::first()->id
            ]
        );
        $city = City::first();
        $this->assertEquals(1, City::count());
        $this->assertEquals('Casablanca', $city->name);
        $this->assertEquals(State::first()->id, $city->state->id);
        $response->assertRedirect();
    }
    public function test_update_city()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->post(
            '/countries',
            [
                'name' => 'Morocco',
                'country_code' => 12333
            ]
        );
        // create state
        $this->post(
            '/states',
            [
                'name' => 'South Africa',
                'country_id' => 1
            ]
        );
        $this->post(
            '/cities',
            [
                'name' => 'Casablanca',
                'state_id' => State::first()->id
            ]
        );
        $city = City::first();
        $response = $this->patch("/cities/{$city->id}", [
            'name' => 'Rabat',
            'state_id' => State::first()->id
        ]);
        $this->assertEquals('Rabat', City::first()->name);
        $this->assertEquals(1, City::first()->state->id);
        $response->assertRedirect();
    }
    public function test_delete_city()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->post(
            '/countries',
            [
                'name' => 'Morocco',
                'country_code' => 12333
            ]
        );
        // create state
        $this->post(
            '/states',
            [
                'name' => 'South Africa',
                'country_id' => 1
            ]
        );
        $this->post(
            '/cities',
            [
                'name' => 'Casablanca',
                'state_id' => State::first()->id
            ]
        );
        $city = City::first();
        $this->assertCount(1, $city->all());
        $response = $this->delete("/cities/{$city->id}");
        $this->assertCount(0, City::all());
        $response->assertRedirect();
    }
}
