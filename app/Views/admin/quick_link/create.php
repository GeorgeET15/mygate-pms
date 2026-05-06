<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Add New Quick Link</h5>
    </div>
    <div class="card-body">
        <form action="/admin/quicklink/create" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Website Title</label>
                <input type="text" name="website_title" class="form-control" placeholder="e.g. Google Search" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">URL / Link</label>
                <input type="url" name="quick_links" class="form-control" placeholder="https://example.com" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/admin/quicklink" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">Save Link</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
