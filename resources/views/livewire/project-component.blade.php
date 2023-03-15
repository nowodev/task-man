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

        @if ($selected_project > 0)
            <livewire:task-component :selected_project="$selected_project" :tasks="$tasks">
        @endif
    </div>
</div>
