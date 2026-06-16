@extends('layouts.admin')

@section('title', 'Edit Experience')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Edit Experience</h2>
        <a href="{{ route('admin.experiences.index') }}" class="text-gray-400 hover:text-white text-sm">
            &larr; Back to Experiences
        </a>
    </div>

    <form method="POST" action="{{ route('admin.experiences.update', $experience) }}" class="space-y-6" x-data="{ isCurrent: {{ old('is_current', $experience->is_current) ? 'true' : 'false' }} }">
        @csrf
        @method('PUT')

        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 space-y-5">
            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-300 mb-1.5">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $experience->title) }}" required
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-500 @enderror"
                       placeholder="e.g. Software Engineer">
                @error('title')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Company or Institution --}}
            <div>
                <label for="company_or_institution" class="block text-sm font-medium text-gray-300 mb-1.5">Company / Institution</label>
                <input type="text" id="company_or_institution" name="company_or_institution" value="{{ old('company_or_institution', $experience->company_or_institution) }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('company_or_institution') border-red-500 @enderror"
                       placeholder="e.g. Google or MIT">
                @error('company_or_institution')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-300 mb-1.5">Type *</label>
                <select id="type" name="type" required
                        class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('type') border-red-500 @enderror">
                    <option value="work" {{ old('type', $experience->type) === 'work' ? 'selected' : '' }}>Work</option>
                    <option value="education" {{ old('type', $experience->type) === 'education' ? 'selected' : '' }}>Education</option>
                </select>
                @error('type')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Start Date --}}
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-300 mb-1.5">Start Date *</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $experience->start_date->format('Y-m-d')) }}" required
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('start_date') border-red-500 @enderror">
                @error('start_date')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- End Date --}}
            <div x-show="!isCurrent">
                <label for="end_date" class="block text-sm font-medium text-gray-300 mb-1.5">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('end_date') border-red-500 @enderror">
                @error('end_date')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Is Current --}}
            <div class="flex items-center">
                <input type="hidden" name="is_current" value="0">
                <input type="checkbox" id="is_current" name="is_current" value="1"
                       x-model="isCurrent"
                       {{ old('is_current', $experience->is_current) ? 'checked' : '' }}
                       class="w-4 h-4 text-indigo-600 bg-gray-900 border-gray-700 rounded focus:ring-indigo-500 focus:ring-offset-gray-900">
                <label for="is_current" class="ml-2 text-sm text-gray-300">Currently working/studying here</label>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-300 mb-1.5">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Describe your role and achievements">{{ old('description', $experience->description) }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Order --}}
            <div>
                <label for="order_column" class="block text-sm font-medium text-gray-300 mb-1.5">Order</label>
                <input type="number" id="order_column" name="order_column" value="{{ old('order_column', $experience->order_column) }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('order_column') border-red-500 @enderror"
                       placeholder="0">
                @error('order_column')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.experiences.index') }}"
               class="px-5 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-lg transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-colors">
                Update Experience
            </button>
        </div>
    </form>
</div>
@endsection
