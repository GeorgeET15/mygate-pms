<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Quick Links</h5>
        <a href="/admin/quicklink/create" class="btn btn-primary btn-sm">Add New Link</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>URL</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($links)): ?>
                        <?php foreach ($links as $row): ?>
                            <tr>
                                <td><strong><?= esc($row['website_title']) ?></strong></td>
                                <td><a href="<?= esc($row['quick_links']) ?>" target="_blank"><?= esc($row['quick_links']) ?></a></td>
                                <td class="text-end">
                                    <a href="/admin/quicklink/delete/<?= $row['id'] ?>" class="btn btn-sm btn-light text-danger confirm-delete" data-message="Are you sure?" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">No links found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
