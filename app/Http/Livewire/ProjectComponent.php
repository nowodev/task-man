<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\Project;
use Livewire\Component;

class ProjectComponent extends Component
{
    public $name;
    public $task_id;
    public $project;
    public $priority;
    public $selected_project = 0;
    public $tasks            = [];
    public $projects         = [];
    public $editing          = false;
    public $createTask       = false;

    public function render()
    {
        $this->projects = Project::get();

        return view('livewire.project-component');
    }

    public function updatedProject($value)
    {
        $this->selected_project = $value;
        $this->tasks            = Task::where('project_id', $value)->get();
        $this->emit('projectSelected', $value);
    }
}
