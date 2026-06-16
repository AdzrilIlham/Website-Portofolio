@extends('layouts.admin')

@section('title', 'Create Skill')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Create Skill</h2>
        <a href="{{ route('admin.skills.index') }}" class="text-gray-400 hover:text-white text-sm">
            &larr; Back to Skills
        </a>
    </div>

    <form method="POST" action="{{ route('admin.skills.store') }}" class="space-y-6">
        @csrf

        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 space-y-5">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1.5">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror"
                       placeholder="e.g. Laravel">
                @error('name')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Icon --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Icon URL <span class="text-gray-500 text-xs">(link gambar SVG/PNG)</span>
                </label>
                <input
                    type="text"
                    name="icon"
                    id="icon-input"
                    value="{{ old('icon') }}"
                    placeholder="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain.svg"
                    class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-blue-500"
                    oninput="previewIcon(this.value)"
                />
                <div id="icon-preview" class="mt-3" style="display:none">
                    <p class="text-xs text-gray-400 mb-1">Preview:</p>
                    <img id="preview-img" src="" alt="icon preview"
                         class="w-12 h-12 object-contain bg-gray-700 rounded p-1" />
                </div>
            </div>

            <script>
            function previewIcon(url) {
                const preview = document.getElementById('icon-preview');
                const img = document.getElementById('preview-img');
                if (url) {
                    img.src = url;
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                }
            }
            </script>

            {{-- Level --}}
            <div x-data="{ level: {{ old('level', 0) }} }">
                <label for="level" class="block text-sm font-medium text-gray-300 mb-1.5">
                    Level: <span x-text="level" class="text-indigo-400 font-semibold"></span>%
                </label>
                <input type="range" id="level" name="level" min="0" max="100" step="5"
                       x-model="level"
                       class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>0%</span>
                    <span>50%</span>
                    <span>100%</span>
                </div>
                @error('level')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category" class="block text-sm font-medium text-gray-300 mb-1.5">Category *</label>
                <select id="category" name="category" required
                        class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('category') border-red-500 @enderror">
                    <option value="Frontend" {{ old('category') === 'Frontend' ? 'selected' : '' }}>Frontend</option>
                    <option value="Backend" {{ old('category') === 'Backend' ? 'selected' : '' }}>Backend</option>
                    <option value="Database" {{ old('category') === 'Database' ? 'selected' : '' }}>Database</option>
                    <option value="Tool" {{ old('category') === 'Tool' ? 'selected' : '' }}>Tool</option>
                    <option value="Other" {{ old('category') === 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('category')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
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
            <a href="{{ route('admin.skills.index') }}"
               class="px-5 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-lg transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-colors">
                Create Skill
            </button>
        </div>
    </form>
</div>
@endsection
