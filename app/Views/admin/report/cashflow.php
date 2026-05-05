<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Cashflow Report Filter</h5>
    </div>
    <div class="card-body">
        <form action="/admin/report/cashflow" method="GET">
            <div class="mb-3">
                <label class="form-label">Property</label>
                <select name="property_id" class="form-select">
                    <option value="all">All Properties</option>
                    <?php foreach($properties as $p): ?>
                        <option value="<?= $p['property_id'] ?>"><?= esc($p['property_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Year</label>
                <input type="number" name="year" class="form-control" value="<?= date('Y') ?>">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
