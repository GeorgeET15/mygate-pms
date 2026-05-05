<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">All Payments / Invoices</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Tenant</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($payments)): ?>
                        <?php foreach ($payments as $row): ?>
                            <tr>
                                <td>#<?= esc($row['InvId']) ?></td>
                                <td><?= esc($row['tenant_name']) ?></td>
                                <td>$<?= esc($row['TotalPrice']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $row['invStatus'] == 'Paid' ? 'success' : 'danger' ?>">
                                        <?= esc($row['invStatus']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">No payments found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
