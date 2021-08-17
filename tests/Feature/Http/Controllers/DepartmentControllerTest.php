<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_render_department_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/departments');
        $response->assertOk();
    }
    public function test_create_department()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/departments', [
            'name' => 'software testing'
        ]);
        $this->assertEquals('software testing', Department::first()->name);
        $this->assertCount(1, Department::all());
        $response->assertRedirect();
    }
    public function test_update_department()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->post('/departments', [
            'name' => 'software testing'
        ]);
        $department = Department::first();
        $response = $this->patch("/departments/{$department->id}", [
            'name' => 'service IT'
        ]);
        $this->assertEquals('service IT', Department::first()->name);
        $response->assertRedirect();
    }
    public function test_delete_department()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->post('/departments', [
            'name' => 'software testing'
        ]);
        $department = Department::first();
        $this->assertCount(1, $department->all());
        $response = $this->delete("/departments/{$department->id}");
        $this->assertCount(0, Department::all());
        $response->assertRedirect();
    }
}
