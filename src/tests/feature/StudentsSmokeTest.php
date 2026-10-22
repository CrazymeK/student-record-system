<?php

use App\Models\StudentModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * Smoke tests for the NORSU Student Record System.
 *
 * These run in the CI "test" job against an in-memory SQLite database
 * (the "tests" group in app/Config/Database.php). The application's own
 * migrations create the students table before each test, so no real
 * database server or production credentials are involved.
 *
 * @internal
 */
final class StudentsSmokeTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    // Run the application's migrations (app/Database/Migrations) for the tests.
    protected $namespace = 'App';
    protected $refresh   = true;

    public function testStudentsIndexPageLoads(): void
    {
        $result = $this->get('students');

        $result->assertOK();
        $result->assertSee('Students');
    }

    public function testModelRejectsAnInvalidStudent(): void
    {
        $model = new StudentModel();

        // Same shape the controller sends: all four fields, some of them bad.
        $saved = $model->insert([
            'student_number' => 'TEST-0002',
            'full_name'      => '',
            'email'          => 'not-an-email',
            'course'         => '',
        ]);

        $this->assertFalse($saved);
        $this->assertArrayHasKey('full_name', $model->errors());
        $this->assertArrayHasKey('email', $model->errors());
        $this->assertArrayHasKey('course', $model->errors());
    }

    public function testModelSavesAndFindsAValidStudent(): void
    {
        $model = new StudentModel();

        $id = $model->insert([
            'student_number' => 'TEST-0001',
            'full_name'      => 'Test Student',
            'email'          => 'test.student@example.com',
            'course'         => 'BS Information Technology',
        ]);

        $this->assertIsInt($id);

        $student = $model->find($id);

        $this->assertSame('TEST-0001', $student['student_number']);
        $this->assertSame('Test Student', $student['full_name']);
    }
}
