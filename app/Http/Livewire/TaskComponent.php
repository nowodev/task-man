<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TaskComponent extends Component
{
    use LivewireAlert;

    public $name;
    public $task_id;
    public $project;
    public $priority;
    public $tasks = [];
    public $selected_project;
    public $editing    = false;
    public $createTask = false;

    protected $listeners = ['refreshComponent', 'projectSelected'];

    /**
     * Before this child component is rendered, the tasks belonging
     * to the selected project are preloaded, to be rendered.
     *
     */
    public function mount($selected_project, $tasks)
    {
        $this->tasks            = $tasks;

        $this->selected_project = $selected_project;
    }

    public function render()
    {
        return view('livewire.task-component');
    }

    public function submit()
    {
        $data = $this->validate([
            'name'     => 'required|string',
            'priority' => 'required',
        ]);

        if ($this->task_id) {
            Task::find($this->task_id)->update($data);

            $this->alert('success', 'Task Updated');
        } else {
            Task::create(['project_id' => $this->selected_project] + $data);

            $this->alert('success', 'Task Created');
        }

        // refresh component after saving
        $this->emit('refreshComponent');

        // empty form parameters for next use
        $this->reset('name', 'priority', 'task_id');

        // disable create/update form
        $this->createTask = false;
    }

    public function cancel()
    {
        $this->createTask = false;
    }

    public function edit($id)
    {
        $task             = Task::find($id);
        $this->task_id    = $id;
        $this->editing    = true;
        $this->createTask = true;
        $this->name       = $task->name;
        $this->priority   = $task->priority;
    }

    public function delete($id)
    {
        Task::find($id)->delete();

        $this->emit('refreshComponent');

        $this->alert('warning', 'Task Deleted');
    }

    public function refreshComponent()
    {
        $this->tasks = Task::where('project_id', $this->selected_project)
            ->orderBy('priority', 'ASC')
            ->get();
    }

    public function projectSelected($value)
    {
        $this->selected_project = $value;

        $this->tasks            = Task::where('project_id', $value)
            ->orderBy('priority', 'ASC')
            ->get();
    }

    public function changePriority($data)
    {
        foreach ($data as $sort) {
            Task::find($sort['value'])->update(['priority' => $sort['order']]);

            $this->emit('refreshComponent');

            $this->alert('info', 'Priority updated');
        }
    }
}
