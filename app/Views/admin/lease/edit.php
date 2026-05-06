<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Edit Lease</h5>
        <a href="/admin/lease" class="btn btn-outline-secondary btn-sm">Back to List</a>
    </div>
    <div class="card-body">
        
        <form action="/admin/lease/edit/<?= esc($lease['leaseId']) ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row g-3">
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tenant <span class="text-danger">*</span></label>
                        <select name="tenantId" class="form-select" required>
                            <?php foreach($tenants as $tenant): ?>
                                <option value="<?= esc($tenant['tenant_id']) ?>" <?= $lease['tenantId'] == $tenant['tenant_id'] ? 'selected' : '' ?>>
                                    <?= esc($tenant['tenant_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Property <span class="text-danger">*</span></label>
                        <select name="property_name" class="form-select" required>
                            <?php foreach($properties as $prop): ?>
                                <option value="<?= esc($prop['property_id']) ?>" <?= $lease['property_name'] == $prop['property_id'] ? 'selected' : '' ?>>
                                    <?= esc($prop['property_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit <span class="text-danger">*</span></label>
                        <select name="vacant_unit" class="form-select" required>
                            <?php foreach($units as $unit): ?>
                                <option value="<?= esc($unit['unit_id']) ?>" <?= $lease['vacant_unit'] == $unit['unit_id'] ? 'selected' : '' ?>>
                                    <?= esc($unit['unit_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Move-in Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="moveinDate" value="<?= esc($lease['moveinDate']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Move-out Date</label>
                            <input type="date" class="form-control" name="moveoutDate" value="<?= esc($lease['moveoutDate']) ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rent Amount <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" name="rentAmount" value="<?= esc($lease['rentAmount']) ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Frequency</label>
                        <select name="frequency" class="form-select">
                            <option value="Monthly" <?= $lease['frequency'] == 'Monthly' ? 'selected' : '' ?>>Monthly</option>
                            <option value="Weekly" <?= $lease['frequency'] == 'Weekly' ? 'selected' : '' ?>>Weekly</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="leaseStatus" class="form-select">
                            <option value="1" <?= $lease['leaseStatus'] == '1' ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= $lease['leaseStatus'] == '0' ? 'selected' : '' ?>>Inactive</option>
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
