<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Unit List</h5>
        <a href="/admin/unit/create" class="btn btn-primary btn-sm">Add New Unit</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Unit Name</th>
                        <th>Type</th>
                        <th>Property</th>
                        <th>Floor</th>
                        <th>Rent</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($units) && is_array($units)): ?>
                        <?php foreach ($units as $unit): ?>
                            <tr>
                                <td><?= esc($unit['unit_id']) ?></td>
                                <td><strong><?= esc($unit['unit_name']) ?></strong></td>
                                <td><span class="badge bg-secondary"><?= esc($unit['unit_type']) ?></span></td>
                                <td><?= esc($unit['prop_name']) ?></td>
                                <td><?= esc($unit['floor_number']) ?></td>
                                <td>$<?= esc($unit['trent']) ?> / <?= esc($unit['trent_period']) ?></td>
                                <td>
                                    <?php if ($unit['vacant_status'] == 1): ?>
                                        <span class="badge status-occupied">Occupied</span>
                                    <?php else: ?>
                                        <span class="badge status-vacant">Vacant</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="/admin/unit/edit/<?= esc($unit['unit_id']) ?>" class="btn btn-sm btn-light text-primary me-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/admin/unit/delete/<?= esc($unit['unit_id']) ?>" class="btn btn-sm btn-light text-danger" onclick="return confirm('Delete this unit?');" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No units found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
