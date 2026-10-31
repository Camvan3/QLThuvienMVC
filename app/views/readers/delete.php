<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="row justify-content-center my-4">
    <div class="col-md-6">
        <a href="<?= BASE_URL ?>/index.php?controller=user&action=index" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Quay lại danh sách
        </a>

        <div class="card border-danger shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-danger text-white py-3 text-center">
                <h5 class="fw-bold mb-0 text-uppercase"><i class="fa-solid fa-user-xmark me-2"></i>Xác nhận xóa tài khoản độc giả</h5>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-warning text-center" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fs-4 me-2"></i>
                    Xóa tài khoản này sẽ xóa toàn bộ thông tin hồ sơ độc giả tương ứng!
                </div>

                <form action="<?= BASE_URL ?>/index.php?controller=user&action=delete&id=<?= $user['id_user'] ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">ID Người dùng:</label>
                        <input type="text" class="form-control bg-light" value="<?= $user['id_user'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên đăng nhập:</label>
                        <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($user['username']) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email:</label>
                        <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="<?= BASE_URL ?>/index.php?controller=user&action=index" class="btn btn-secondary w-50 fw-bold py-2">Hủy bỏ</a>
                        <button type="submit" class="btn btn-danger w-50 fw-bold py-2"><i class="fa-solid fa-trash me-1"></i> Đồng ý xóa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>