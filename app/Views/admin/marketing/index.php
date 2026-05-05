<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Marketing Listings</h5>
        <a href="/admin/marketing/create" class="btn btn-primary btn-sm">Add New Listing</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Property</th>
                        <th>Available Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listings)): ?>
                        <?php foreach ($listings as $row): ?>
                            <tr>
                                <td><strong><?= esc($row['postingTitle']) ?></strong></td>
                                <td><?= esc($row['propertyName']) ?></td>
                                <td><?= esc($row['availableDate']) ?></td>
                                <td class="text-end">
                                    <a href="/admin/marketing/delete/<?= $row['marketing_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">No listings found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
