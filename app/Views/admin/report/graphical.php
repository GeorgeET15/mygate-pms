<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Graphical Analytics</h5>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i> Graphical reports require Chart.js integration. Coming soon in the next update.
        </div>
        <form action="/admin/report/graphical" method="GET">
            <div class="row g-3">
                <div class="col-md-5">
                    <select name="property_id" class="form-select">
                        <option value="all">All Properties</option>
                        <?php foreach($properties as $p): ?>
                            <option value="<?= $p['property_id'] ?>"><?= esc($p['property_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="number" name="year" class="form-control" value="<?= date('Y') ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Plot</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
