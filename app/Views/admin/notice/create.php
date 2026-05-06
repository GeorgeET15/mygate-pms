<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Add New Notice</h5>
    </div>
    <div class="card-body">
        <form action="/admin/notice/create" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Notice Title</label>
                <input type="text" name="notice_title" class="form-control" placeholder="e.g. Annual Maintenance Schedule" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Notice Content</label>
                <textarea name="notice" class="form-control" rows="6" placeholder="Enter the full details of the notice..." required></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/admin/notice" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">Post Notice</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
