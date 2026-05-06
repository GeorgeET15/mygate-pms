<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Work Orders</h5>
        <a href="/admin/workorder/create" class="btn btn-primary btn-sm">Create Work Order</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Property</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($work_orders)): ?>
                        <?php foreach ($work_orders as $row): ?>
                            <tr>
                                <td><?= $row['wo_id'] ?></td>
                                <td><strong><?= esc($row['JobTitle']) ?></strong></td>
                                <td><?= esc($row['property_name']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $row['isWorkDone'] == 'Yes' ? 'success' : 'info' ?>">
                                        <?= esc($row['isWorkDone'] == 'Yes' ? 'Completed' : 'Pending') ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/admin/workorder/delete/<?= $row['wo_id'] ?>" class="btn btn-sm btn-light text-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No work orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
