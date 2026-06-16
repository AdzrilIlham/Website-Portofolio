@extends('layouts.admin')

@section('title', 'Skills')

@section('content')
<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Skills</h2>
        <a href="{{ route('admin.skills.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Skill
        </a>
    </div>

    @if($skills->isEmpty())
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-12 text-center">
            <svg class="w-12 h-12 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
            <p class="text-gray-400">No skills found. Create your first skill!</p>
        </div>
    @else
        <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Level</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($skills as $skill)
                            <tr class="hover:bg-gray-750 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($skill->icon)
                                            <img src="{{ $skill->icon }}" alt="{{ $skill->name }}"
                                                 class="w-8 h-8 object-contain rounded mr-2"
                                                 onerror="this.style.display='none'">
                                        @endif
                                        <span class="text-sm font-medium text-white">{{ $skill->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full
                                        {{ $skill->category === 'Frontend' ? 'bg-blue-900/50 text-blue-300' : '' }}
                                        {{ $skill->category === 'Backend' ? 'bg-green-900/50 text-green-300' : '' }}
                                        {{ $skill->category === 'Database' ? 'bg-yellow-900/50 text-yellow-300' : '' }}
                                        {{ $skill->category === 'Tool' ? 'bg-purple-900/50 text-purple-300' : '' }}
                                        {{ !in_array($skill->category, ['Frontend','Backend','Database','Tool']) ? 'bg-gray-700 text-gray-300' : '' }}">
                                        {{ $skill->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-24 bg-gray-700 rounded-full h-2 mr-3">
                                            <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ $skill->level }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-400">{{ $skill->level }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    {{ $skill->order_column }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <a href="{{ route('admin.skills.edit', $skill) }}"
                                       class="text-indigo-400 hover:text-indigo-300 mr-3">Edit</a>
                                    <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" class="inline"
                                          x-data
                                          @submit.prevent="
                                              if (confirm('Are you sure you want to delete this skill?')) {
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
