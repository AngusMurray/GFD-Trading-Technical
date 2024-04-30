<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DepartmentSeeder::class);
    }
    
    public function test_user_management_page_is_displayed(): void
    {
        $managementUser = User::factory()->isManagement()->create();

        $response = $this
            ->actingAs($managementUser)
            ->get(route('users.index'));

        $response->assertOk();
        $response->assertInertia(function (Assert $page) {
            $page->has('users');
        });
    }

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('profile.edit', ['user' => $user->id]));

        $response->assertOk();
    }

    public function test_a_management_user_can_view_another_users_profile_page(): void
    {
        $user = User::factory()->create();
        $managementUser = User::factory()->isManagement()->create();

        $response = $this
            ->actingAs($managementUser)
            ->get(route('profile.edit', ['user' => $user->id]));

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->patch(route('profile.update', ['user' => $user->id]), [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'department_id' => Department::first()->id
            ]);

        $response->assertSessionHasNoErrors()->assertRedirect(route('profile.edit', ['user' => $user->id]));
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('profile.edit', ['user' => $user->id]), [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response->assertSessionHasNoErrors();

        $this->assertNotNull($user->refresh()->email_verified_at);
    }
}
