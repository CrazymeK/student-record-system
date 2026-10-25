
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0", style="color: pink;">Student Records Management System</h1>
    <a href="<?= site_url('students/create') ?>" class="btn btn-primary">+ Add Student</a>
</div>

<?php if (empty($students)): ?>

    <div class="alert alert-info">
        No student records yet.
        <a href="<?= site_url('students/create') ?>" class="btn btn-sm btn-success ms-2">Add Student</a>
    </div>

<?php else: ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white align-middle border-primary">
            <thead style="background-color: #183153; color: white;">
                <tr>
                    <th>Student Number</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th class="text-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= esc($student['student_number']) ?></td>
                        <td><?= esc($student['full_name']) ?></td>
                        <td><?= esc($student['email']) ?></td>
                        <td><?= esc($student['course']) ?></td>
                        <td class="text-nowrap">
                            <a href="<?= site_url('students/' . $student['id']) ?>" class="btn btn-sm btn-primary">View</a>
                            <a href="<?= site_url('students/' . $student['id'] . '/edit') ?>" class="btn btn-sm" style="background-color: #fd7e14; color: white;">Edit</a>
                            <form method="post" action="<?= site_url('students/' . $student['id'] . '/delete') ?>"
                                  class="d-inline" onsubmit="return confirm('Delete this student?')">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?= $pager->links('default', 'bootstrap') ?>

<?php endif; ?>

<?= $this->endSection() ?>
