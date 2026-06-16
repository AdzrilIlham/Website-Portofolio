@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Edit Profile</h2>
    </div>

    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 space-y-5">
            {{-- Photo --}}
            <div x-data="{ preview: '{{ $profile->photo ? asset('storage/' . $profile->photo) : '' }}' }">
                <label class="block text-sm font-medium text-gray-300 mb-2">Photo</label>
                <div class="flex items-center space-x-6">
                    <div class="shrink-0">
                        <template x-if="preview">
                            <img :src="preview" class="w-20 h-20 rounded-full object-cover border-2 border-gray-600" alt="Photo preview">
                        </template>
                        <template x-if="!preview">
                            <div class="w-20 h-20 rounded-full bg-gray-700 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </template>
                    </div>
                    <label class="cursor-pointer">
                        <span class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm rounded-lg border border-gray-600 transition-colors">
                            Choose Photo
                        </span>
                        <input type="file" name="photo" class="hidden" accept="image/*" @change="
                            const file = $event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => preview = e.target.result;
                                reader.readAsDataURL(file);
                            }
                        ">
                    </label>
                </div>
                @error('photo')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1.5">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $profile->name) }}" required
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror"
                       placeholder="Your name">
                @error('name')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tagline --}}
            <div>
                <label for="tagline" class="block text-sm font-medium text-gray-300 mb-1.5">Tagline</label>
                <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $profile->tagline) }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('tagline') border-red-500 @enderror"
                       placeholder="e.g. Full Stack Developer">
                @error('tagline')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-300 mb-1.5">Description</label>
                <textarea id="description" name="description" rows="3"
                          class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Short description about yourself">{{ old('description', $profile->description) }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- About Description --}}
            <div>
                <label for="about_description" class="block text-sm font-medium text-gray-300 mb-1.5">About Description</label>
                <textarea id="about_description" name="about_description" rows="4"
                          class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('about_description') border-red-500 @enderror"
                          placeholder="Detailed about section">{{ old('about_description', $profile->about_description) }}</textarea>
                @error('about_description')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- CV URL --}}
            <div>
                <label for="cv_url" class="block text-sm font-medium text-gray-300 mb-1.5">CV URL</label>
                <input type="url" id="cv_url" name="cv_url" value="{{ old('cv_url', $profile->cv_url) }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('cv_url') border-red-500 @enderror"
                       placeholder="https://example.com/cv.pdf">
                @error('cv_url')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $profile->email) }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror"
                       placeholder="you@example.com">
                @error('email')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- GitHub --}}
            <div>
                <label for="github" class="block text-sm font-medium text-gray-300 mb-1.5">GitHub URL</label>
                <input type="url" id="github" name="github" value="{{ old('github', $profile->github) }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('github') border-red-500 @enderror"
                       placeholder="https://github.com/username">
                @error('github')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- LinkedIn --}}
            <div>
                <label for="linkedin" class="block text-sm font-medium text-gray-300 mb-1.5">LinkedIn URL</label>
                <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin', $profile->linkedin) }}"
                       class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('linkedin') border-red-500 @enderror"
                       placeholder="https://linkedin.com/in/username">
                @error('linkedin')
                    <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-colors duration-200">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
