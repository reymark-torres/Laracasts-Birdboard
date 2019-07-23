<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use Facades\Tests\Setup\ProjectFactory;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks->first()->path(), ['body' => 'Changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Changed']);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertRedirect($project->path());

        $this->get($project->path())
            ->assertSee('Test task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'Changed.',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Changed.',
            'completed' => true
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::create();

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
