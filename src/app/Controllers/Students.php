<?php

namespace App\Controllers;

use App\Models\StudentModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Student CRUD: list, add, view, edit, and delete students.
 */
class Students extends BaseController
{
    /**
     * @var StudentModel Talks to the students table.
     */
    protected StudentModel $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    /**
     * Show the list of students, 10 per page.
     */
    public function index(): string
    {
        $data = [
            'title'    => 'Students | HAHAHHAHAHAHAHAHAHAHAAHh',
            'students' => $this->studentModel->orderBy('id', 'DESC')->paginate(10),
            'pager'    => $this->studentModel->pager,
        ];

        return view('students/hahah', $data);
    }

    /**
     * Show the "Add Student" form.
     */
    public function create(): string
    {
        return view('students/create', ['title' => 'Add Student']);
    }

    /**
     * Save a new student from the submitted form.
     */
    public function store(): RedirectResponse
    {
        $data = [
            'student_number' => $this->request->getPost('student_number'),
            'full_name'      => $this->request->getPost('full_name'),
            'email'          => $this->request->getPost('email'),
            'course'         => $this->request->getPost('course'),
        ];

        // insert() runs the model validation rules for us.
        if ($this->studentModel->insert($data) === false) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->studentModel->errors());
        }

        return redirect()->to('/students')
            ->with('success', 'Student added successfully.');
    }

    /**
     * Show one student's details.
     */
    public function show(int $id): string
    {
        $student = $this->findStudentOrFail($id);

        return view('students/show', [
            'title'   => 'Student Details',
            'student' => $student,
        ]);
    }

    /**
     * Show the "Edit Student" form.
     */
    public function edit(int $id): string
    {
        $student = $this->findStudentOrFail($id);

        return view('students/edit', [
            'title'   => 'Edit Student',
            'student' => $student,
        ]);
    }

    /**
     * Save changes to an existing student.
     */
    public function update(int $id): RedirectResponse
    {
        $this->findStudentOrFail($id);

        $data = [
            // "id" is included so the is_unique rule can ignore this student's own row.
            'id'             => $id,
            'student_number' => $this->request->getPost('student_number'),
            'full_name'      => $this->request->getPost('full_name'),
            'email'          => $this->request->getPost('email'),
            'course'         => $this->request->getPost('course'),
        ];

        if ($this->studentModel->update($id, $data) === false) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->studentModel->errors());
        }

        return redirect()->to('/students')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Delete a student.
     */
    public function delete(int $id): RedirectResponse
    {
        $this->findStudentOrFail($id);

        $this->studentModel->delete($id);

        return redirect()->to('/students')
            ->with('success', 'Student deleted successfully.');
    }

    /**
     * Find a student by id, or show a 404 page.
     *
     * @return array<string, mixed>
     */
    protected function findStudentOrFail(int $id): array
    {
        $student = $this->studentModel->find($id);

        if ($student === null) {
            throw PageNotFoundException::forPageNotFound("Student #{$id} was not found.");
        }

        return $student;
    }
}
