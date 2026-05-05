<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Rental Applicant List</h5>
        <a href="/admin/application/create" class="btn btn-primary btn-sm">Add New Application</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Applicant</th>
                        <th>Contact</th>
                        <th>Property</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($apps)): ?>
                        <?php foreach ($apps as $row): ?>
                            <tr>
                                <td><?= esc($row['application_date']) ?></td>
                                <td><strong><?= esc($row['full_name']) ?></strong></td>
                                <td><?= esc($row['phone_number']) ?></td>
                                <td><?= esc($row['prop_name']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $row['rent_status'] == 0 ? 'warning' : ($row['rent_status'] == 1 ? 'success' : 'danger') ?>">
                                        <?= $row['rent_status'] == 0 ? 'Pending' : ($row['rent_status'] == 1 ? 'Approved' : 'Rejected') ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/admin/application/delete/<?= $row['appinfo_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">No applications found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
