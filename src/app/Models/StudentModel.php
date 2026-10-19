<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Handles all database work for the students table.
 */
class StudentModel extends Model
{
    protected $table      = 'students';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    // Only these columns may be inserted or updated.
    protected $allowedFields = [
        'student_number',
        'full_name',
        'email',
        'course',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Validation
     * The "id" rule exists only so {id} can be used in is_unique on update.
     *
     * @var string[]
     */
    protected $validationRules = [
        'id'             => 'permit_empty|is_natural_no_zero',
        'student_number' => 'required|max_length[20]|is_unique[students.student_number,id,{id}]',
        'full_name'      => 'required|min_length[2]|max_length[100]',
        'email'          => 'required|valid_email|max_length[100]',
        'course'         => 'required|max_length[100]',
    ];

    /**
     * Validation Messages
     *
     * @var array[]
     */
    protected $validationMessages = [
        'student_number' => [
            'required'  => 'Student number is required.',
            'is_unique' => 'This student number is already registered.',
        ],
        'full_name' => [
            'required'   => 'Full name is required.',
            'min_length' => 'Full name must be at least 2 characters.',
        ],
        'email' => [
            'required'    => 'Email is required.',
            'valid_email' => 'Please enter a valid email address.',
        ],
        'course' => [
            'required' => 'Course is required.',
        ],
    ];
}
