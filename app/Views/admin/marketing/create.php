<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm col-md-10 mx-auto">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Add New Marketing Listing</h5>
    </div>
    <div class="card-body">
        <form action="/admin/marketing/create" method="POST">
            <?= csrf_field() ?>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Marketing Name</label>
                    <input type="text" name="marketingName" class="form-control" placeholder="Internal name for tracking" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Posting Title</label>
                    <input type="text" name="postingTitle" class="form-control" placeholder="Public title for the ad" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Select Property</label>
                    <select name="propertyName" class="form-select" required>
                        <option value="">Select Property...</option>
                        <?php foreach($properties as $p): ?>
                            <option value="<?= esc($p['property_id']) ?>"><?= esc($p['property_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Vacant Unit</label>
                    <input type="text" name="vacantUnit" class="form-control" placeholder="e.g. Unit 402">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Available Date</label>
                    <input type="date" name="availableDate" class="form-control">
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Short Description</label>
                    <input type="text" name="shortDescription" class="form-control" placeholder="One-line summary">
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Full Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Detailed property features, amenities, etc."></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Website / Link</label>
                    <input type="url" name="website" class="form-control" placeholder="External listing URL">
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="d-flex gap-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="AllowPets" value="1" id="pets">
                            <label class="form-check-label" for="pets">Allow Pets</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="AllowSmoking" value="1" id="smoking">
                            <label class="form-check-label" for="smoking">Allow Smoking</label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex gap-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="published" value="1" id="published" checked>
                            <label class="form-check-label" for="published">Published</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="featuredRental" value="1" id="featured">
                            <label class="form-check-label" for="featured">Featured Listing</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="forsale" value="1" id="forsale">
                            <label class="form-check-label" for="forsale">For Sale</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between">
                <a href="/admin/marketing" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">Create Listing</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
