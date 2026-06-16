@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div>
    <h2 class="text-2xl font-bold text-white mb-6">Dashboard</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Skills Card --}}
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 hover:border-indigo-500 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Skills</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $totalSkills }}</p>
                </div>
                <div class="w-12 h-12 bg-indigo-600/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.skills.index') }}" class="text-sm text-indigo-400 hover:text-indigo-300">View all skills &rarr;</a>
            </div>
        </div>

        {{-- Projects Card --}}
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 hover:border-green-500 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Projects</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $totalProjects }}</p>
                </div>
                <div class="w-12 h-12 bg-green-600/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.projects.index') }}" class="text-sm text-green-400 hover:text-green-300">View all projects &rarr;</a>
            </div>
        </div>

        {{-- Experiences Card --}}
        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 hover:border-amber-500 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400">Total Experiences</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $totalExperiences }}</p>
                </div>
                <div class="w-12 h-12 bg-amber-600/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.experiences.index') }}" class="text-sm text-amber-400 hover:text-amber-300">View all experiences &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection
