<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><?= esc($title) ?></h5>
        <a href="/admin/lease/create" class="btn btn-primary btn-sm">Add New Lease</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tenant</th>
                        <th>Property/Unit</th>
                        <th>Period</th>
                        <th>Rent</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($leases)): ?>
                        <?php foreach ($leases as $row): ?>
                            <tr>
                                <td><?= esc($row['leaseId']) ?></td>
                                <td><strong><?= esc($row['tenant_name'] ?? 'N/A') ?></strong></td>
                                <td><?= esc($row['property_name'] ?? 'N/A') ?> / <?= esc($row['unit_name'] ?? 'N/A') ?></td>
                                <td><?= esc($row['moveinDate']) ?> to <?= esc($row['moveoutDate']) ?></td>
                                <td>$<?= esc($row['rentAmount']) ?> (<?= esc($row['frequency']) ?>)</td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="/admin/lease/renew/<?= $row['leaseId'] ?>" class="btn btn-sm btn-outline-success">Renew</a>
                                        <a href="/admin/lease/terminate/<?= $row['leaseId'] ?>" class="btn btn-sm btn-outline-warning">Terminate</a>
                                        <a href="/admin/lease/delete/<?= $row['leaseId'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">No leases found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
