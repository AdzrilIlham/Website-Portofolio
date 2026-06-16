@extends('layouts.admin')

@section('title', 'Projects')

@section('content')
<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Projects</h2>
        <a href="{{ route('admin.projects.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Project
        </a>
    </div>

    @if($projects->isEmpty())
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-12 text-center">
            <svg class="w-12 h-12 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <p class="text-gray-400">No projects found. Create your first project!</p>
        </div>
    @else
        <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Featured</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Tech Stack</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($projects as $project)
                            <tr class="hover:bg-gray-750 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-white">{{ $project->title }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($project->image)
                                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                             class="w-10 h-10 rounded-lg object-cover border border-gray-600">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-gray-700 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($project->is_featured)
                                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-yellow-900/50 text-yellow-300">
                                            Featured
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-gray-700 text-gray-400">
                                            No
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $techs = is_array($project->tech_stack)
                                            ? $project->tech_stack
                                            : explode(',', $project->tech_stack ?? '');
                                    @endphp
                                    @if(count($techs))
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($techs as $tech)
                                                <span class="px-2 py-0.5 text-xs rounded bg-gray-700 text-gray-300">{{ trim($tech) }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                       class="text-indigo-400 hover:text-indigo-300 mr-3">Edit</a>
                                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="inline"
                                          x-data
                                          @submit.prevent="
                                              if (confirm('Are you sure you want to delete this project?')) {
                                                  $el.submit();
                                              }
                                          ">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
