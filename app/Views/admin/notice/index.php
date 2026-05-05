<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Noticeboard</h5>
        <a href="/admin/notice/create" class="btn btn-primary btn-sm">Add New Notice</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Notice</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($notices)): ?>
                        <?php foreach ($notices as $row): ?>
                            <tr>
                                <td><?= date('d M, Y', $row['create_timestamp']) ?></td>
                                <td><strong><?= esc($row['notice_title']) ?></strong></td>
                                <td><?= esc(substr($row['notice'], 0, 100)) ?>...</td>
                                <td class="text-end">
                                    <a href="/admin/notice/edit/<?= $row['notice_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <a href="/admin/notice/delete/<?= $row['notice_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">No notices found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
