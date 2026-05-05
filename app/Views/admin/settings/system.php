<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">System Configuration</h5>
    </div>
    <div class="card-body">
        <form action="/admin/settings/system" method="POST">
            <?= csrf_field() ?>
            <?php foreach ($settings as $s): ?>
                <div class="mb-3">
                    <label class="form-label"><?= ucwords(str_replace('_', ' ', $s['type'])) ?></label>
                    <input type="text" class="form-control" name="<?= esc($s['type']) ?>" value="<?= esc($s['description']) ?>">
                </div>
            <?php endforeach; ?>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save All Settings</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
