<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="row justify-content-center my-4">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header card-header-soft-blue py-3 text-center border-0">
                <h5 class="fw-bold mb-0 text-uppercase"><i class="fa-solid fa-user-plus me-2"></i>Đăng ký tài khoản độc giả</h5>
            </div>
            
            <div class="card-body p-4 bg-white">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 text-center" role="alert">
                        <i class="fa-solid fa-circle-exclamation me-1"></i><?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/index.php?controller=auth&action=register" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Tên đăng nhập / Mã SV:</label>
                        <input type="text" name="username" class="form-control form-control-lg bg-light border-0" placeholder="Ví dụ: 2351160740" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Email trường (TLU):</label>
                        <input type="email" name="email" class="form-control form-control-lg border" placeholder="Ví dụ: sinhvien@tlu.edu.vn" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Mật khẩu:</label>
                        <input type="password" name="password" class="form-control form-control-lg bg-light border-0" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-soft-blue btn-lg w-100 fw-bold shadow-sm mb-3">
                        <i class="fa-solid fa-check me-2"></i>Hoàn tất đăng ký
                    </button>

                    <div class="text-center mt-3">
                        <span class="text-muted small">Đã có tài khoản?</span> 
                        <a href="<?= BASE_URL ?>/index.php?controller=auth&action=login" class="text-primary fw-semibold text-decoration-none">Đăng nhập ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>