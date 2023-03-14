<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                    <div class="mb-12">
                        <label for="" class="mb-3 block text-base font-medium text-black">
                            Projects
                        </label>
                        <div class="relative">
                            <select wire:model="project"
                                class="border-form-stroke text-body-color focus:border-primary active:border-primary w-full appearance-none rounded-lg border-[1.5px] py-3 px-5 font-medium outline-none transition disabled:cursor-default disabled:bg-[#F5F7FD]">
                                <option value="null" disabled>Select a project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" wire:key="project-{{ $project->id }}"">
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>

                            <span
                                class="border-body-color absolute right-4 top-1/2 mt-[-2px] h-[10px] w-[10px] -translate-y-1/2 rotate-45 border-r-2 border-b-2">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($selected > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="px-4">
                        <x-primary-button wire:click="$toggle('createTask')">Create Task</x-primary-button>
                    </div>

                    <div class="flex flex-col mt-8 px-4">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                                    Name
                                                </th>
                                                <th
                                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                                    Priority
                                                </th>
                                                <th
                                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                                    Created
                                                </th>
                                                <th
                                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse($tasks as $task)
                                                <tr>
                                                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $task->name }}
                                                        </p>
                                                    </td>
                                                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $task->priority }}
                                                        </p>
                                                    </td>
                                                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $task->created_at->diffForHumans() }}
                                                        </p>
                                                    </td>
                                                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                        <div class="flex items-center justify-end space-x-3">
                                                            <x-secondary-button wire:click="edit({{ $task->id }})">
                                                                Edit
                                                            </x-secondary-button>

                                                            <x-danger-button
                                                                onclick="return confirm('Are you sure you want to delete
                                                                this category?') || event.stopImmediatePropagation()"
                                                                wire:click="delete({{ $task->id }})">Delete
                                                            </x-danger-button>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="3"
                                                        class="px-5 py-5 text-sm text-center bg-white border-b border-gray-200">
                                                        <p class="text-gray-900 whitespace-no-wrap">No Record Found
                                                        </p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif



        {{-- Create/Edit  --}}
        @if ($selected > 0 && $createTask)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                        <div class="mb-12">
                            <h2 class="mb-3 block text-base font-medium text-black">
                                Create Task
                            </h2>

                            <div class="relative flex gap-x-4 mb-3">
                                <div class="space-y-2">
                                    <x-input-label>Name</x-input-label>
                                    <x-text-input wire:model="name" class="p-3 border-2" />
                                    {{-- <x-input-error  /> --}}
                                </div>

                                <div class="space-y-2">
                                    <x-input-label>Priority</x-input-label>
                                    <x-text-input wire:model="priority" type="number" class="p-3 border-2" />
                                    {{-- <x-text-input wire:model="priority" type="number" class="p-3 border-2" /> --}}
                                </div>
                            </div>

                            <div class="mb-3">
                                <x-error />
                            </div>

                            <x-primary-button wire:click="submit">Save</x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
