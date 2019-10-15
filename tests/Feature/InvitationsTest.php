<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_project_can_invite_a_user()
    {
        // Given I have a project
        $project = ProjectFactory::create();

        // And the owner of the project invites another user
        $project->invite($newUser = factory(\App\User::class)->create());

        /** Then that new user will have permission to add task */
        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
