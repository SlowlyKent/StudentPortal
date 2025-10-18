<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AnnouncementModel;

class Announcement extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to view announcements.');
            return redirect()->to(base_url('login'));
        }

        // Use AnnouncementModel to fetch all announcements, ordered by created_at in descending order (newest first)
        $announcementModel = new AnnouncementModel();
        $announcements = $announcementModel->getAllAnnouncements();

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
            'announcements' => $announcements,
            'title' => 'Announcements'
        ];

        return view('announcements', $data);
    }
}
