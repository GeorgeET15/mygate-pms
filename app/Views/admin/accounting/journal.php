<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Accounting Journal</h5>
        <a href="/admin/accounting/add_journal" class="btn btn-primary btn-sm">Add Journal Entry</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>JV #</th>
                        <th>Description</th>
                        <th>Account</th>
                        <th class="text-end">Debit</th>
                        <th class="text-end">Credit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($journal_entries)): ?>
                        <?php foreach ($journal_entries as $row): ?>
                            <tr>
                                <td><?= date('d M, Y', $row['jv_date']) ?></td>
                                <td><?= esc($row['jv_no']) ?></td>
                                <td><?= esc($row['narration']) ?></td>
                                <td><?= esc($row['account_name']) ?></td>
                                <td class="text-end text-success">$<?= esc($row['dr_amt']) ?></td>
                                <td class="text-end text-danger">$<?= esc($row['cr_amt']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">No entries found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
