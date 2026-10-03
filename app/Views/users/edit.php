<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Edit User Account</h2>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <form action="/users/update/<?= $user['id'] ?>" method="post" enctype="multipart/form-data" class="mt-3">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= old('username', $user['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?= old('full_name', $user['full_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Current Avatar</label><br>
            <?php if (!empty($user['avatar']) && file_exists(FCPATH . 'uploads/avatars/' . $user['avatar'])): ?>
                <img src="/uploads/avatars/<?= $user['avatar'] ?>" alt="Avatar" class="rounded-circle border mb-2" width="80" height="80">
            <?php else: ?>
                <span class="text-muted">No avatar uploaded</span>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Upload New Avatar (JPG/PNG, Max 2MB)</label>
            <input type="file" name="avatar" class="form-control" accept="image/png, image/jpeg">
        </div>
        <button type="submit" class="btn btn-success">Update User</button>
        <a href="/users" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>