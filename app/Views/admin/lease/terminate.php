<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-danger text-white py-3">
        <h5 class="mb-0">Terminate Lease</h5>
    </div>
    <div class="card-body">
        <form action="/admin/lease/terminate/<?= $lease_id ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="leaseId" value="<?= $lease_id ?>">
            <div class="mb-3">
                <label class="form-label">Termination Date</label>
                <input type="date" name="leavingDate" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Reason for Leaving</label>
                <textarea name="leavingReason" class="form-control" rows="3" required placeholder="Describe why the tenant is leaving..."></textarea>
            </div>
            <div class="text-end">
                <a href="/admin/lease" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-danger">Confirm Termination</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
