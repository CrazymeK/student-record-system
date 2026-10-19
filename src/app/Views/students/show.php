<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1 class="h3 mb-3">Student Details</h1>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr>
                <th class="w-25">Student Number</th>
                <td><?= esc($student['student_number']) ?></td>
            </tr>
            <tr>
                <th>Full Name</th>
                <td><?= esc($student['full_name']) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= esc($student['email']) ?></td>
            </tr>
            <tr>
                <th>Course</th>
                <td><?= esc($student['course']) ?></td>
            </tr>
            <tr>
                <th>Created At</th>
                <td><?= esc(date('M j, Y g:i A', strtotime($student['created_at']))) ?></td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td><?= esc(date('M j, Y g:i A', strtotime($student['updated_at']))) ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="<?= site_url('students/' . $student['id'] . '/edit') ?>" class="btn btn-warning">Edit Student</a>
    <a href="<?= site_url('students') ?>" class="btn btn-secondary">Back to Students</a>
    <form method="post" action="<?= site_url('students/' . $student['id'] . '/delete') ?>"
          class="d-inline" onsubmit="return confirm('Delete this student?')">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>

<?= $this->endSection() ?>
