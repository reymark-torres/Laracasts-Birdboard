<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    function it_has_a_user()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->assertInstanceOf(User::class, $project->activity->first()->user);
    }

}
