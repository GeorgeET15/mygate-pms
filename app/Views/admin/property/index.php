<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Property List</h5>
        <a href="/admin/property/create" class="btn btn-primary btn-sm">Add New Property</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>City</th>
                        <th>Address</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($properties) && is_array($properties)): ?>
                        <?php foreach ($properties as $property): ?>
                            <tr>
                                <td><?= esc($property['property_id']) ?></td>
                                <td><strong><?= esc($property['property_name']) ?></strong></td>
                                <td><span class="badge bg-secondary"><?= esc($property['property_type']) ?></span></td>
                                <td><?= esc($property['city']) ?></td>
                                <td class="text-muted"><?= esc($property['property_address']) ?></td>
                                <td class="text-end">
                                    <a href="/admin/property/edit/<?= esc($property['property_id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <a href="/admin/property/delete/<?= esc($property['property_id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No properties found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
