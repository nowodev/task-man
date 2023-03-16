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

    /**
     * This is a livewire lifecycle hook that gets triggered whe the 'project' property is updated.
     * Once a project is selected, all tasks belonging to the project are queried. An event is
     * then emitted to the child component 'TaskComponent' and the tasks are populated there.
     *
     */
    public function updatedProject($value)
    {
        $this->selected_project = $value;

        $this->tasks            = Task::where('project_id', $value)
            ->orderBy('priority', 'ASC')
            ->get();

        $this->emit('projectSelected', $value);
    }
}
