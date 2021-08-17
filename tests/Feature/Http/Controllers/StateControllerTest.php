<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StateControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_render_state_index()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/states');
        $response->assertStatus(200);
    }
    public function test_can_create_new_state()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->post(
            '/countries',
            [
                'name' => 'Morocco',
                'country_code' => 122
            ]
        );
        $response = $this->post('/states', [
            'name' => 'South Africa',
            'country_id' => Country::first()->id
        ]);

        $state = State::first();
        $this->assertEquals(1, State::count());
        $response->assertStatus(302);
        $this->assertEquals('South Africa', $state->name);
        $this->assertEquals(Country::first()->id, $state->country->id);
        // redirect the page

        $response->assertRedirect();
    }
    public function test_state_can_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        // create country for the foreign key
        $this->post('/countries', [
            'name' => 'Egybt',
            'country_code' => 123
        ]);
        // create state 
        $this->post('/states', [
            'name' => 'South Africa',
            'country_id' => Country::first()->id
        ]);
        // retrieve state
        $state = State::first();
        $response = $this->patch("/states/{$state->id}", [
            'name' => 'South America',
            'country_code' => Country::first()->id
        ]);
        $this->assertEquals('South Africa', $state->name);
        $this->assertEquals(1, $state->country_id);
        // redirect to index page
        $response->assertRedirect();
    }
    public function test_can_delete_state()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        // create category
        $this->post('/countries', [
            'name' => 'USA',
            'country_code' => 1222
        ]);
        // create state 
        $this->post('/states', [
            'name' => 'South Africa',
            'country_id' => Country::first()->id
        ]);
        $state = State::first();
        $response = $this->delete("/states/{$state->id}");
        $response->assertRedirect();
    }
}
