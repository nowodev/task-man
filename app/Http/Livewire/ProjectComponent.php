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
    public $tasks = [];
    public $selected = 0;
    public $projects = [];
    public $editing = false;
    public $createTask = false;

    public function render()
    {
        $this->projects = Project::get();

        return view('livewire.project-component');
    }

    public function updatedProject($value)
    {
        $this->selected = $value;
        $this->tasks    = Task::where('project_id', $value)->get();
    }

    public function submit()
    {
        $data = $this->validate([
            'name'     => 'required|string',
            'priority' => 'required',
        ]);

        if ($this->task_id) {
            Task::find($this->task_id)->update($data);
        } else {
            Task::create(['project_id' => $this->selected] + $data);
        }

        $this->reset();
        $this->createTask = false;
    }

    public function edit($id)
    {
        $task          = Task::find($id);
        $this->task_id = $id;

        $this->editing    = true;
        $this->createTask = true;
        $this->name       = $task->name;
        $this->priority   = $task->priority;
    }

    public function delete($id)
    {
        Task::find($id)->delete();
        $this->reset();
    }
}
