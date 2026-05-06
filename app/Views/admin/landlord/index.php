<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Landlord List</h5>
        <a href="/admin/landlord/create" class="btn btn-primary btn-sm">Add New Landlord</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($landlords)): ?>
                        <?php foreach ($landlords as $row): ?>
                            <tr>
                                <td><?= $row['landlord_id'] ?></td>
                                <td><strong><?= esc($row['first_name']) ?> <?= esc($row['last_name']) ?></strong></td>
                                <td><?= esc($row['contact_no']) ?></td>
                                <td><?= esc($row['address']) ?>, <?= esc($row['city']) ?></td>
                                <td class="text-end">
                                    <a href="/admin/landlord/delete/<?= $row['landlord_id'] ?>" class="btn btn-sm btn-light text-danger confirm-delete" data-message="Are you sure?" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No landlords found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
