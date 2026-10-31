<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="row justify-content-center my-4">
    <div class="col-md-6">
        <a href="<?= BASE_URL ?>/index.php?controller=book&action=index" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Quay lại danh sách
        </a>

        <div class="card border-danger shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-danger text-white py-3 text-center">
                <h5 class="fw-bold mb-0 text-uppercase"><i class="fa-solid fa-triangle-exclamation me-2"></i>Xác nhận xóa thông tin sách</h5>
            </div>
            <div class="card-body p-4 text-center">
                <div class="alert alert-warning text-center" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fs-4 me-2"></i>
                    Bạn có chắc chắn muốn xóa cuốn sách này khỏi thư viện?
                </div>

                <form action="<?= BASE_URL ?>/index.php?controller=book&action=delete&id=<?= $book->getIdBook() ?>" method="POST">
                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold">Mã sách:</label>
                        <input type="text" class="form-control bg-light" value="<?= $book->getIdBook() ?>" readonly>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold">Tên sách:</label>
                        <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($book->getTitle()) ?>" readonly>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold">Tác giả:</label>
                        <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($book->getAuthor()) ?>" readonly>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="<?= BASE_URL ?>/index.php?controller=book&action=index" class="btn btn-secondary w-50 fw-bold py-2">Hủy bỏ</a>
                        <button type="submit" class="btn btn-danger w-50 fw-bold py-2"><i class="fa-solid fa-trash me-1"></i> Đồng ý xóa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>