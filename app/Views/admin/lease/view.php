<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0">Lease Details: #<?= esc($lease['leaseId']) ?></h5>
                <div class="btn-group">
                    <a href="/admin/lease/edit/<?= esc($lease['leaseId']) ?>" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <a href="/admin/lease" class="btn btn-outline-secondary btn-sm">Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <label class="text-muted small text-uppercase fw-bold">Tenant Name</label>
                        <p class="fs-5 fw-bold text-dark"><?= esc($lease['tenant_name']) ?></p>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <label class="text-muted small text-uppercase fw-bold">Status</label>
                        <div>
                            <span class="badge <?= $lease['leaseStatus'] == 1 ? 'status-active' : 'status-inactive' ?>">
                                <?= $lease['leaseStatus'] == 1 ? 'Active' : 'Inactive' ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <h6 class="fw-bold mb-3">Property Information</h6>
                            <p class="mb-1 text-muted small">Property</p>
                            <p class="fw-medium"><?= esc($lease['property_name']) ?></p>
                            <p class="mb-1 text-muted small">Unit</p>
                            <p class="fw-medium"><?= esc($lease['unit_name']) ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <h6 class="fw-bold mb-3">Lease Terms</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Move-in Date</span>
                                <span class="fw-medium"><?= esc($lease['moveinDate']) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Move-out Date</span>
                                <span class="fw-medium"><?= esc($lease['moveoutDate'] ?? 'Not Set') ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">Frequency</span>
                                <span class="fw-medium"><?= esc($lease['frequency']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm mb-4" style="background: var(--blue-gradient);">
            <div class="card-body p-4 text-center">
                <i class="bi bi-cash-stack fs-1 mb-2"></i>
                <h6 class="text-uppercase small fw-bold mb-1">Monthly Rent</h6>
                <h2 class="fw-bold mb-0">$<?= number_format((float)$lease['rentAmount'], 2) ?></h2>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="/admin/lease/renew/<?= esc($lease['leaseId']) ?>" class="btn btn-outline-dark text-start">
                        <i class="bi bi-arrow-repeat me-2"></i> Renew Lease
                    </a>
                    <a href="/admin/lease/terminate/<?= esc($lease['leaseId']) ?>" class="btn btn-outline-danger text-start">
                        <i class="bi bi-x-circle me-2"></i> Terminate Lease
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
