<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Maintenance Log</h5>
        <a href="/admin/maintenance/create" class="btn btn-primary btn-sm">Add New Entry</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Property</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($logs)): ?>
                        <?php foreach ($logs as $row): ?>
                            <tr>
                                <td><?= esc($row['when_done']) ?></td>
                                <td><strong><?= esc($row['MaintenanceTitle']) ?></strong></td>
                                <td><?= esc($row['prop_name']) ?></td>
                                <td><?= esc($row['UnitName']) ?></td>
                                <td><?= esc($row['Category']) ?></td>
                                <td class="text-end">
                                    <a href="/admin/maintenance/delete/<?= $row['maintenance_log_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">No logs found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
