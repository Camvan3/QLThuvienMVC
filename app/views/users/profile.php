<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="row justify-content-center my-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-primary text-white text-center py-3">
                <h5 class="fw-bold mb-0"><i class="fa-solid fa-id-card me-2"></i>HỒ SƠ CÁ NHÂN SINH VIÊN</h5>
            </div>
            <div class="card-body p-4">
                <form action="<?= BASE_URL ?>/index.php?controller=user&action=updateProfile" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên đăng nhập:</label>
                        <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($_SESSION['user']['username']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email trường / Cá nhân:</label>
                        <input type="email" class="form-control bg-light" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Vai trò hệ thống:</label>
                        <input type="text" class="form-control bg-light" value="<?= $_SESSION['user']['role'] == 'admin' ? 'Quản trị viên' : 'Sinh viên' ?>" readonly>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ và tên độc giả:</label>
                        <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($reader_info['full_name'] ?? '') ?>" placeholder="Nhập họ tên...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Số điện thoại liên hệ:</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($reader_info['phone'] ?? '') ?>" placeholder="Nhập số điện thoại...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Lớp học phần:</label>
                        <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($reader_info['address'] ?? '') ?>" placeholder="Nhập địa chỉ / lớp...">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2"><i class="fa-solid fa-floppy-disk me-1"></i> Cập nhật thông tin</button>
                    <div class="card-body p-4">
                    <!-- HIỂN THỊ THÔNG BÁO NẾU CÓ SESSION SUCCESS -->
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i><?= $_SESSION['success'] ?>
                            <button type="type" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['success']); // Xóa thông báo sau khi hiển thị ?>
                    <?php endif; ?>

                    <form action="<?= BASE_URL ?>/index.php?controller=user&action=updateProfile" method="POST">
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>