<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Edit Lease</h5>
        <a href="/admin/lease" class="btn btn-outline-secondary btn-sm">Back to List</a>
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

        <form action="/admin/lease/edit/<?= esc($lease['lease_id']) ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row g-3">
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tenant <span class="text-danger">*</span></label>
                        <select name="tenant_id" class="form-select" required>
                            <?php foreach($tenants as $tenant): ?>
                                <option value="<?= esc($tenant['tenant_id']) ?>" <?= $lease['tenant_id'] == $tenant['tenant_id'] ? 'selected' : '' ?>>
                                    <?= esc($tenant['tenant_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Property <span class="text-danger">*</span></label>
                        <select name="property_id" class="form-select" required>
                            <?php foreach($properties as $prop): ?>
                                <option value="<?= esc($prop['property_id']) ?>" <?= $lease['property_id'] == $prop['property_id'] ? 'selected' : '' ?>>
                                    <?= esc($prop['property_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit <span class="text-danger">*</span></label>
                        <select name="unit_id" class="form-select" required>
                            <?php foreach($units as $unit): ?>
                                <option value="<?= esc($unit['unit_id']) ?>" <?= $lease['unit_id'] == $unit['unit_id'] ? 'selected' : '' ?>>
                                    <?= esc($unit['unit_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="start_date" value="<?= esc($lease['start_date']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="end_date" value="<?= esc($lease['end_date']) ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rent Amount <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" name="rent_amount" value="<?= esc($lease['rent_amount']) ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deposit Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" name="deposit_amount" value="<?= esc($lease['deposit_amount']) ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="Active" <?= $lease['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                            <option value="Inactive" <?= $lease['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>

            </div>
            
            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Update Lease</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
