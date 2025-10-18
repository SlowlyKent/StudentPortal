<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Welcome to the New Academic Year 2025-2026',
                'content' => 'We are excited to welcome all students, teachers, and staff to the new academic year 2025-2026. This year brings new opportunities for learning and growth. Please make sure to check your course schedules and attend all orientation sessions. We look forward to a successful and productive year ahead!',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'title' => 'Important: Midterm Examination Schedule',
                'content' => 'The midterm examinations for the first semester will be held from October 20-25, 2025. Please review your examination schedule carefully and ensure you arrive on time for all your exams. Remember to bring your student ID and required materials. Good luck to all students!',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
        ];

        // Insert the data into the announcements table
        $this->db->table('announcements')->insertBatch($data);
    }
}
