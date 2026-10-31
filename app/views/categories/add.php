<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="row justify-content-center my-4">
    <div class="col-md-6">
        <a href="<?= BASE_URL ?>/index.php?controller=category&action=index" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Quay lại danh sách
        </a>

        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header card-header-tlu py-3">
                <h5 class="fw-bold mb-0"><i class="fa-solid fa-plus me-2"></i>Thêm Thể loại Sách mới</h5>
            </div>
            <div class="card-body p-4">
                <form action="<?= BASE_URL ?>/index.php?controller=category&action=add" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên thể loại <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="Ví dụ: Khoa học máy tính, Kinh tế lượng...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mô tả thể loại</label>
                        <textarea name="des" class="form-control" rows="4" placeholder="Nhập mô tả chi tiết cho thể loại này..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary fw-bold px-4 py-2"><i class="fa-solid fa-floppy-disk me-1"></i> Lưu thể loại</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>