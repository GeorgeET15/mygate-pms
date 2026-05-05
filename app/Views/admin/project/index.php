<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Project List</h5>
        <a href="/admin/project/create" class="btn btn-primary btn-sm">Add New Project</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($projects)): ?>
                        <?php foreach ($projects as $row): ?>
                            <tr>
                                <td><?= $row['project_id'] ?></td>
                                <td><strong><?= esc($row['project_name']) ?></strong></td>
                                <td><?= esc($row['project_description']) ?></td>
                                <td class="text-end">
                                    <a href="/admin/project/edit/<?= $row['project_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <a href="/admin/project/delete/<?= $row['project_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">No projects found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
