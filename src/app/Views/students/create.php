<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<h1 class="h3 mb-3">Add Student</h1>

<div class="card">
    <div class="card-body">
        <form method="post" action="<?= site_url('students') ?>">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="student_number" class="form-label">Student Number</label>
                <input type="text" name="student_number" id="student_number"
                       class="form-control <?= isset($errors['student_number']) ? 'is-invalid' : '' ?>"
                       value="<?= esc(old('student_number')) ?>">
                <?php if (isset($errors['student_number'])): ?>
                    <div class="invalid-feedback"><?= esc($errors['student_number']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" name="full_name" id="full_name"
                       class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>"
                       value="<?= esc(old('full_name')) ?>">
                <?php if (isset($errors['full_name'])): ?>
                    <div class="invalid-feedback"><?= esc($errors['full_name']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email"
                       class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                       value="<?= esc(old('email')) ?>">
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback"><?= esc($errors['email']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" name="course" id="course"
                       class="form-control <?= isset($errors['course']) ? 'is-invalid' : '' ?>"
                       value="<?= esc(old('course')) ?>">
                <?php if (isset($errors['course'])): ?>
                    <div class="invalid-feedback"><?= esc($errors['course']) ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Save Student</button>
            <a href="<?= site_url('students') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
