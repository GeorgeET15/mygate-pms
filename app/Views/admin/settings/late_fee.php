<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Late Fee Configuration</h5>
    </div>
    <div class="card-body">
        <form action="/admin/settings/late_fee" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Fee Amount ($)</label>
                <input type="text" class="form-control" name="fee_amount" value="<?= esc($settings['fee_amount'] ?? '0') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Fee Ratio (%)</label>
                <input type="text" class="form-control" name="fee_ratio" value="<?= esc($settings['fee_ratio'] ?? '0') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Fee Frequency (Days)</label>
                <input type="number" class="form-control" name="fee_frequency" value="<?= esc($settings['fee_frequency'] ?? '1') ?>">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Update Settings</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
