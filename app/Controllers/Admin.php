<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    public function dashboard()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Access denied. Admin privileges required.');
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
            'title' => 'Admin Dashboard'
        ];

        return view('admin_dashboard', $data);
    }
}