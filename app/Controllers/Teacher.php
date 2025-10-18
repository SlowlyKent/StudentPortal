<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Teacher extends Controller
{
    public function dashboard()
    {
        // Check if user is logged in and is teacher
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'teacher') {
            session()->setFlashdata('error', 'Access denied. Teacher privileges required.');
            return redirect()->to(base_url('login'));
        }

        // Get user data for the view
        $userData = [
            'id' => session()->get('user_id'),
            'name' => session()->get('name'),
            'email' => session()->get('email'),
            'role' => session()->get('role')
        ];

        // Prepare data for the view
        $data = [
            'user' => $userData,
            'title' => 'Teacher Dashboard'
        ];

        return view('teacher_dashboard', $data);
    }
}