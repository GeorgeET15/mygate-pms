<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Add New Unit</h5>
        <a href="/admin/unit" class="btn btn-outline-secondary btn-sm">Back to List</a>
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

        <form action="/admin/unit/create" method="POST">
            <?= csrf_field() ?>
            <div class="row g-3">
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Unit Name/Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="unit_name" value="<?= old('unit_name') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit Type</label>
                        <select name="unit_type" class="form-select">
                            <option value="">Select Type</option>
                            <option value="Apartment">Apartment</option>
                            <option value="House">House</option>
                            <option value="Condo">Condo</option>
                            <option value="Townhouse">Townhouse</option>
                            <option value="Commercial">Commercial</option>
                        </select>
                    </div>

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
                        <label class="form-label">Floor Number</label>
                        <input type="text" class="form-control" name="floor_number" value="<?= old('floor_number') ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Bedrooms</label>
                        <input type="number" class="form-control" name="bedrooms" value="<?= old('bedrooms') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bathrooms</label>
                        <input type="number" step="0.5" class="form-control" name="bathrooms" value="<?= old('bathrooms') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rent Amount <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" name="trent" value="<?= old('trent') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rent Period</label>
                        <select name="trent_period" class="form-select">
                            <option value="Monthly" <?= old('trent_period') == 'Monthly' ? 'selected' : '' ?>>Monthly</option>
                            <option value="Weekly" <?= old('trent_period') == 'Weekly' ? 'selected' : '' ?>>Weekly</option>
                            <option value="Yearly" <?= old('trent_period') == 'Yearly' ? 'selected' : '' ?>>Yearly</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="vacant_status" class="form-select">
                            <option value="0" <?= old('vacant_status') == '0' ? 'selected' : '' ?>>Vacant</option>
                            <option value="1" <?= old('vacant_status') == '1' ? 'selected' : '' ?>>Occupied</option>
                        </select>
                    </div>
                </div>

            </div>
            
            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save Unit</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
