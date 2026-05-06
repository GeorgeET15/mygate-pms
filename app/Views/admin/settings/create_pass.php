<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Add New Password Entry</h5>
    </div>
    <div class="card-body">
        <form action="/admin/settings/create_pass" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Title / Site Name</label>
                <input type="text" name="title" class="form-control" placeholder="e.g. AWS Console" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Login URL</label>
                <input type="url" name="url" class="form-control" placeholder="https://portal.example.com">
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Internal Notes</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/admin/settings/pass_storer" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">Save Credentials</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
