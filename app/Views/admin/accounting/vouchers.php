<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Debit Vouchers</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Voucher #</th>
                        <th>Narration</th>
                        <th class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($vouchers)): ?>
                        <?php foreach ($vouchers as $row): ?>
                            <tr>
                                <td><?= date('Y-m-d', $row['journal_date'] ?? time()) ?></td>
                                <td><?= esc($row['journal_id']) ?></td>
                                <td><?= esc($row['description']) ?></td>
                                <td class="text-end">$<?= esc($row['dr_amt'] ?? '0.00') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">No vouchers found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
