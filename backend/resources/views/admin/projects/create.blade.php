@extends('layouts.admin')

@section('title', 'Create Project')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Create Project</h2>
        <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-white text-sm">
            &larr; Back to Projects
        </a>
    </div>

    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 space-y-5">
            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-300 mb-1.5">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-500 @enderror"
                       placeholder="Project title">
                @error('title')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-300 mb-1.5">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Describe your project">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tech Stack --}}
            <div x-data="{ tags: {{ old('tech_stack') ? json_encode(explode(',', old('tech_stack'))) : '[]' }}, input: '' }">
                <label for="tech_stack" class="block text-sm font-medium text-gray-300 mb-1.5">Tech Stack (comma separated)</label>
                <input type="hidden" name="tech_stack" :value="tags.join(', ')">
                <div class="flex flex-wrap gap-2 mb-2">
                    <template x-for="(tag, index) in tags" :key="index">
                        <span class="inline-flex items-center px-3 py-1 bg-indigo-600/20 text-indigo-300 text-sm rounded-lg border border-indigo-600/30">
                            <span x-text="tag"></span>
                            <button type="button" @click="tags.splice(index, 1)" class="ml-1.5 text-indigo-400 hover:text-indigo-200">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </span>
                    </template>
                </div>
                <input type="text" x-model="input"
                       @keydown.enter.prevent="if (input.trim()) { tags.push(input.trim()); input = ''; }"
                       @keydown.comma.prevent="if (input.trim()) { tags.push(input.trim()); input = ''; }"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                       placeholder="Type a tech and press Enter or comma">
                <p class="mt-1.5 text-xs text-gray-500">Press Enter or comma to add a tag</p>
                @error('tech_stack')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div x-data="{ preview: '' }">
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Image</label>
                <div class="flex items-center space-x-4">
                    <template x-if="preview">
                        <img :src="preview" class="w-20 h-20 rounded-lg object-cover border border-gray-600" alt="Preview">
                    </template>
                    <label class="cursor-pointer">
                        <span class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm rounded-lg border border-gray-600 transition-colors">
                            Choose Image
                        </span>
                        <input type="file" name="image" class="hidden" accept="image/*" @change="
                            const file = $event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => preview = e.target.result;
                                reader.readAsDataURL(file);
                            }
                        ">
                    </label>
                </div>
                @error('image')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Demo URL --}}
            <div>
                <label for="demo_url" class="block text-sm font-medium text-gray-300 mb-1.5">Demo URL</label>
                <input type="url" id="demo_url" name="demo_url" value="{{ old('demo_url') }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('demo_url') border-red-500 @enderror"
                       placeholder="https://demo.example.com">
                @error('demo_url')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- GitHub URL --}}
            <div>
                <label for="github_url" class="block text-sm font-medium text-gray-300 mb-1.5">GitHub URL</label>
                <input type="url" id="github_url" name="github_url" value="{{ old('github_url') }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('github_url') border-red-500 @enderror"
                       placeholder="https://github.com/user/repo">
                @error('github_url')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Is Featured --}}
            <div class="flex items-center">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" id="is_featured" name="is_featured" value="1"
                       {{ old('is_featured') ? 'checked' : '' }}
                       class="w-4 h-4 text-indigo-600 bg-gray-900 border-gray-700 rounded focus:ring-indigo-500 focus:ring-offset-gray-900">
                <label for="is_featured" class="ml-2 text-sm text-gray-300">Featured Project</label>
            </div>

            {{-- Order --}}
            <div>
                <label for="order_column" class="block text-sm font-medium text-gray-300 mb-1.5">Order</label>
                <input type="number" id="order_column" name="order_column" value="{{ old('order_column', 0) }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('order_column') border-red-500 @enderror"
                       placeholder="0">
                @error('order_column')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.projects.index') }}"
               class="px-5 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-lg transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-colors">
                Create Project
            </button>
        </div>
    </form>
</div>
@endsection
