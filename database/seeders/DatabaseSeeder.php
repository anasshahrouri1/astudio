<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Timesheet;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $project = Project::create([
            'name' => 'Sample Project',
            'status' => 'active',
        ]);

        $attribute = Attribute::create([
            'name' => 'department',
            'type' => 'text',
        ]);

        AttributeValue::create([
            'attribute_id' => $attribute->id,
            'entity_id' => $project->id,
            'value' => 'IT',
        ]);

        Timesheet::create([
            'task_name' => 'Initial Setup',
            'date' => now(),
            'hours' => 5,
            'user_id' => 1,
            'project_id' => $project->id,
        ]);
    }
}
