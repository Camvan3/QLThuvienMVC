<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="mb-3">
    <a href="<?= BASE_URL ?>/index.php?controller=category&action=index" class="btn btn-outline-secondary btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Quay lại danh sách
    </a>
</div>

<div class="card border-danger shadow-sm rounded-4 overflow-hidden col-md-6 mx-auto bg-white">
    <div class="card-header bg-danger text-white py-3 text-center border-0">
        <h5 class="fw-bold mb-0 text-uppercase">
            <i class="fa-solid fa-triangle-exclamation me-2"></i>Xác nhận xóa thể loại
        </h5>
    </div>

    <div class="card-body p-4">
        <div class="alert alert-warning py-3 text-center rounded-3 mb-4">
            <i class="fa-solid fa-triangle-exclamation me-1"></i>
            <b>Cảnh báo:</b> Hành động này sẽ xóa vĩnh viễn thể loại khỏi hệ thống!
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary">Mã thể loại (ID):</label>
            <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($category->getIdCategory()) ?>" readonly>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary">Tên thể loại:</label>
            <input type="text" class="form-control bg-light fw-bold text-dark" value="<?= htmlspecialchars($category->getNameCategory()) ?>" readonly>
        </div>

        <!-- FORM GỬI LỆNH XÓA (POST) -->
        <form action="<?= BASE_URL ?>/index.php?controller=category&action=delete&id=<?= $category->getIdCategory() ?>" method="POST">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger fw-bold w-100 py-2 shadow-sm">
                    <i class="fa-solid fa-trash me-2"></i>Xác nhận xóa
                </button>
                <a href="<?= BASE_URL ?>/index.php?controller=category&action=index" class="btn btn-light w-100 py-2 border">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>