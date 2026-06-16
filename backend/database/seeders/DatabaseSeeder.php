<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        // Create profile
        Profile::create([
            'name' => 'Adzril',
            'tagline' => 'Full-Stack Developer',
            'description' => 'Passionate full-stack developer with expertise in building modern web applications. I love turning complex problems into simple, beautiful, and intuitive solutions.',
            'about_description' => 'I am a dedicated full-stack developer with over 3 years of experience in building web applications. My journey in tech started with a curiosity for how things work on the web, and it has evolved into a passion for creating impactful digital experiences. I specialize in Laravel and React, and I am always eager to learn new technologies and take on challenging projects.',
            'photo' => null,
            'cv_url' => null,
            'email' => 'adzril774@gmail.com',
            'github' => 'https://github.com/adzril',
            'linkedin' => 'https://linkedin.com/in/adzril',
        ]);

        // Create skills
        $skills = [
            ['name' => 'Laravel', 'icon' => 'laravel', 'level' => 90, 'category' => 'Backend', 'order_column' => 1],
            ['name' => 'React', 'icon' => 'react', 'level' => 85, 'category' => 'Frontend', 'order_column' => 2],
            ['name' => 'JavaScript', 'icon' => 'javascript', 'level' => 88, 'category' => 'Frontend', 'order_column' => 3],
            ['name' => 'PHP', 'icon' => 'php', 'level' => 92, 'category' => 'Backend', 'order_column' => 4],
            ['name' => 'MySQL', 'icon' => 'mysql', 'level' => 80, 'category' => 'Database', 'order_column' => 5],
            ['name' => 'Tailwind CSS', 'icon' => 'tailwindcss', 'level' => 85, 'category' => 'Frontend', 'order_column' => 6],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Create projects
        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'description' => 'A full-featured e-commerce platform with product management, cart functionality, payment integration with Stripe, and an admin dashboard for managing orders and inventory.',
                'tech_stack' => ['Laravel', 'React', 'MySQL', 'Stripe API', 'Tailwind CSS'],
                'image' => null,
                'demo_url' => 'https://demo-ecommerce.example.com',
                'github_url' => 'https://github.com/adzril/ecommerce',
                'is_featured' => true,
                'order_column' => 1,
            ],
            [
                'title' => 'Task Manager Pro',
                'description' => 'A collaborative task management application with real-time updates, drag-and-drop boards, team workspaces, and detailed analytics for project tracking.',
                'tech_stack' => ['Laravel', 'Vue.js', 'MySQL', 'WebSocket', 'Tailwind CSS'],
                'image' => null,
                'demo_url' => 'https://demo-taskmanager.example.com',
                'github_url' => 'https://github.com/adzril/task-manager',
                'is_featured' => true,
                'order_column' => 2,
            ],
            [
                'title' => 'Real-Time Chat App',
                'description' => 'A real-time messaging application supporting private and group chats, file sharing, typing indicators, and message read receipts using Laravel WebSockets.',
                'tech_stack' => ['Laravel', 'React', 'Pusher', 'MySQL', 'Tailwind CSS'],
                'image' => null,
                'demo_url' => null,
                'github_url' => 'https://github.com/adzril/chat-app',
                'is_featured' => false,
                'order_column' => 3,
            ],
            [
                'title' => 'Portfolio Website',
                'description' => 'A modern, responsive portfolio website built with a Laravel API backend and React frontend, featuring a custom CMS for easy content management.',
                'tech_stack' => ['Laravel', 'React', 'MySQL', 'Sanctum', 'Tailwind CSS'],
                'image' => null,
                'demo_url' => 'https://adzril.dev',
                'github_url' => 'https://github.com/adzril/portfolio',
                'is_featured' => true,
                'order_column' => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // Create experiences
        $experiences = [
            [
                'title' => 'Full-Stack Developer',
                'company_or_institution' => 'Tech Solutions Inc.',
                'type' => 'work',
                'start_date' => '2023-01-15',
                'end_date' => null,
                'is_current' => true,
                'description' => 'Developing and maintaining full-stack web applications using Laravel and React. Implementing RESTful APIs, managing databases, collaborating with cross-functional teams, and mentoring junior developers.',
                'order_column' => 1,
            ],
            [
                'title' => 'Junior Web Developer',
                'company_or_institution' => 'Digital Agency Co.',
                'type' => 'work',
                'start_date' => '2021-06-01',
                'end_date' => '2022-12-31',
                'is_current' => false,
                'description' => 'Built responsive websites and web applications for various clients. Worked with PHP, Laravel, JavaScript, and MySQL. Participated in code reviews and agile development processes.',
                'order_column' => 2,
            ],
            [
                'title' => 'Bachelor of Computer Science',
                'company_or_institution' => 'University of Technology',
                'type' => 'education',
                'start_date' => '2018-09-01',
                'end_date' => '2022-05-30',
                'is_current' => false,
                'description' => 'Graduated with honors. Coursework included Data Structures, Algorithms, Database Systems, Software Engineering, and Web Development. Led the university coding club.',
                'order_column' => 3,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }
}
