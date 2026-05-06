<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-success text-white py-3">
        <h5 class="mb-0">Renew Lease</h5>
    </div>
    <div class="card-body">
        <form action="/admin/lease/renew/<?= $lease['leaseId'] ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="leaseId" value="<?= $lease['leaseId'] ?>">
            <div class="mb-3">
                <label class="form-label">New Move-in Date</label>
                <input type="date" name="moveinDate" class="form-control" value="<?= $lease['moveoutDate'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">New Move-out Date</label>
                <input type="date" name="moveoutDate" class="form-control" required>
            </div>
            <div class="text-end">
                <a href="/admin/lease" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-success">Confirm Renewal</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
