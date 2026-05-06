<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Tenant List</h5>
        <a href="/admin/tenant/create" class="btn btn-primary btn-sm">Add New Tenant</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tenant Name</th>
                        <th>Contact</th>
                        <th>Property</th>
                        <th>Unit</th>
                        <th>Frequency</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tenants) && is_array($tenants)): ?>
                        <?php foreach ($tenants as $tenant): ?>
                            <tr>
                                <td><?= esc($tenant['tenant_id']) ?></td>
                                <td><strong><?= esc($tenant['tenant_name']) ?></strong></td>
                                <td><?= esc($tenant['tenant_contact']) ?></td>
                                <td><?= esc($tenant['prop_name']) ?></td>
                                <td><span class="badge bg-secondary"><?= esc($tenant['unit_name']) ?></span></td>
                                <td><?= esc($tenant['frequency']) ?></td>
                                <td>
                                    <?php if ($tenant['tenantStatus'] == 'Active'): ?>
                                        <span class="badge status-active">Active</span>
                                    <?php else: ?>
                                        <span class="badge status-inactive">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="/admin/tenant/edit/<?= esc($tenant['tenant_id']) ?>" class="btn btn-sm btn-light text-primary me-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/admin/tenant/delete/<?= esc($tenant['tenant_id']) ?>" class="btn btn-sm btn-light text-danger confirm-delete" data-message="Delete this tenant?" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No tenants found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
