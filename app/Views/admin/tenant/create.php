<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Add New Tenant</h5>
        <a href="/admin/tenant" class="btn btn-outline-secondary btn-sm">Back to List</a>
    </div>
    <div class="card-body">
        
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                <?php foreach (session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="/admin/tenant/create" method="POST">
            <?= csrf_field() ?>
            <div class="row g-3">
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Application ID (Optional)</label>
                        <input type="number" class="form-control" name="appinfo_id" value="<?= old('appinfo_id') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tenant Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tenant_name" value="<?= old('tenant_name') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Info <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tenant_contact" value="<?= old('tenant_contact') ?>" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Property <span class="text-danger">*</span></label>
                        <select name="property_name" class="form-select" required>
                            <option value="">Select Property</option>
                            <?php foreach($properties as $prop): ?>
                                <option value="<?= esc($prop['property_id']) ?>" <?= old('property_name') == $prop['property_id'] ? 'selected' : '' ?>>
                                    <?= esc($prop['property_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit <span class="text-danger">*</span></label>
                        <select name="vacant_unit" class="form-select" required>
                            <option value="">Select Unit</option>
                            <?php foreach($units as $unit): ?>
                                <option value="<?= esc($unit['unit_id']) ?>" <?= old('vacant_unit') == $unit['unit_id'] ? 'selected' : '' ?>>
                                    <?= esc($unit['unit_name']) ?> (<?= esc($unit['unit_type']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Frequency</label>
                        <select name="frequency" class="form-select">
                            <option value="Monthly" <?= old('frequency') == 'Monthly' ? 'selected' : '' ?>>Monthly</option>
                            <option value="Weekly" <?= old('frequency') == 'Weekly' ? 'selected' : '' ?>>Weekly</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="tenantStatus" class="form-select">
                            <option value="Active" <?= old('tenantStatus') == 'Active' ? 'selected' : '' ?>>Active</option>
                            <option value="Inactive" <?= old('tenantStatus') == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>

            </div>
            
            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save Tenant</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
