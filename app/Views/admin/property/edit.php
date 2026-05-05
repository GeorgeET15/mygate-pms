<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Edit Property</h5>
        <a href="/admin/property" class="btn btn-outline-secondary btn-sm">Back to List</a>
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

        <form action="/admin/property/edit/<?= esc($property['property_id']) ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row g-3">
                
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Property Type <span class="text-danger">*</span></label>
                        <select name="property_type" class="form-select" required>
                            <option value="">Select Property Type</option>
                            <option value="1" <?= $property['property_type'] == '1' ? 'selected' : '' ?>>Office</option>
                            <option value="2" <?= $property['property_type'] == '2' ? 'selected' : '' ?>>Industrial</option>
                            <option value="3" <?= $property['property_type'] == '3' ? 'selected' : '' ?>>Retail</option>
                            <option value="4" <?= $property['property_type'] == '4' ? 'selected' : '' ?>>Healthcare</option>
                            <option value="5" <?= $property['property_type'] == '5' ? 'selected' : '' ?>>Government</option>
                            <option value="6" <?= $property['property_type'] == '6' ? 'selected' : '' ?>>Airport</option>
                            <option value="7" <?= $property['property_type'] == '7' ? 'selected' : '' ?>>Garage/Parking</option>
                            <option value="8" <?= $property['property_type'] == '8' ? 'selected' : '' ?>>Apartment Building</option>
                            <option value="9" <?= $property['property_type'] == '9' ? 'selected' : '' ?>>Duplex / Triplex</option>
                            <option value="10" <?= $property['property_type'] == '10' ? 'selected' : '' ?>>Mobile Home / RV Community</option>
                            <option value="12" <?= $property['property_type'] == '12' ? 'selected' : '' ?>>Residential</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Property Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="property_name" value="<?= esc($property['property_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Frequency</label>
                        <select name="frequency" class="form-select">
                            <option value="">Please Select</option>
                            <option value="Weekly" <?= $property['frequency'] == 'Weekly' ? 'selected' : '' ?>>Weekly</option>
                            <option value="Monthly" <?= $property['frequency'] == 'Monthly' ? 'selected' : '' ?>>Monthly</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Number of Units</label>
                        <input type="number" class="form-control" name="unit" value="<?= esc($property['unit']) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Area</label>
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control" name="tarea" value="<?= esc($property['tarea']) ?>">
                            <select name="tarea_munit" class="form-select" style="max-width: 120px;">
                                <option value="Sq Ft" <?= $property['tarea_munit'] == 'Sq Ft' ? 'selected' : '' ?>>Sq Ft</option>
                                <option value="Sq M" <?= $property['tarea_munit'] == 'Sq M' ? 'selected' : '' ?>>Sq M</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="property_address" value="<?= esc($property['property_address']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">City <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="city" value="<?= esc($property['city']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Country <span class="text-danger">*</span></label>
                        <select name="property_country" class="form-select" required>
                            <option value="usa" <?= $property['property_country'] == 'usa' ? 'selected' : '' ?>>United States</option>
                            <option value="uk" <?= $property['property_country'] == 'uk' ? 'selected' : '' ?>>United Kingdom</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">State/Province <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="property_province" value="<?= esc($property['property_province']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Zip/Postal Code</label>
                        <input type="text" class="form-control" name="zip_code" value="<?= esc($property['zip_code']) ?>">
                    </div>
                </div>

            </div>
            
            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Update Property</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
