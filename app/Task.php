<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    /**
     * Mark the task as complete
     */
    public function complete()
    {
        $this->update(['completed' => true]);

        $this->project->recordActivity('completed_task');
    }

    /**
     * Mark the task as incomplete
     */
    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->project->recordActivity('incompleted_task');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->getKey()}/tasks/{$this->getKey()}";
    }
}
