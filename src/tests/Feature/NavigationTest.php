<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_users_see_user_routes_in_the_header(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('href="'.route('dashboard').'"', false);
        $response->assertSee('href="'.route('quizzes.index').'"', false);
        $response->assertSee('管理画面');
    }

    public function test_admin_users_see_admin_routes_in_the_header(): void
    {
        $admin = User::factory()->create([
            'is_admin' => 1,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSee('href="'.route('admin.dashboard').'"', false);
        $response->assertSee('href="'.route('admin.quizzes.index').'"', false);
        $response->assertSee('管理画面');
    }
}
