<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'title',
        'content',
        'created_at'
    ];

    // Dates
    protected $useTimestamps = false; // We'll handle created_at manually
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'content' => 'required|min_length[10]'
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Title is required',
            'min_length' => 'Title must be at least 3 characters long',
            'max_length' => 'Title cannot exceed 255 characters'
        ],
        'content' => [
            'required' => 'Content is required',
            'min_length' => 'Content must be at least 10 characters long'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get all announcements ordered by created_at in descending order (newest first)
     * 
     * @return array
     */
    public function getAllAnnouncements()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    /**
     * Get announcements with pagination
     * 
     * @param int $perPage
     * @param int $page
     * @return array
     */
    public function getAnnouncementsPaginated($perPage = 10, $page = 1)
    {
        return $this->orderBy('created_at', 'DESC')
            ->paginate($perPage, 'default', $page);
    }
}
