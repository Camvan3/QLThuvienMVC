<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="mb-3">
    <a href="<?= BASE_URL ?>/index.php?controller=book&action=index" class="btn btn-outline-secondary btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Quay lại danh sách
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden col-md-8 mx-auto bg-white mb-5">
    <!-- HEADER ĐỔI SANG TONE XANH DỊU PASTEL -->
    <div class="card-header card-header-soft-blue py-3 border-0">
        <h5 class="fw-bold mb-0 text-white text-uppercase">
            <i class="fa-solid fa-pen-to-square me-2"></i>Chỉnh sửa thông tin sách
        </h5>
    </div>

    <div class="card-body p-4">
        <!-- BẮT BUỘC PHẢI CÓ enctype="multipart/form-data" ĐỂ SỬA VÀ UPLOAD ẢNH -->
        <form action="<?= BASE_URL ?>/index.php?controller=book&action=edit&id=<?= $book->getIdBook() ?>" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label class="form-label fw-semibold text-dark">Tên sách <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control bg-light border-0" value="<?= htmlspecialchars($book->getTitle()) ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-dark">Thể loại <span class="text-danger">*</span></label>
                    <select name="id_category" class="form-select border" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat->getIdCategory() ?>" <?= ($cat->getIdCategory() == $book->getIdCategory()) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat->getNameCategory()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-dark">Tác giả <span class="text-danger">*</span></label>
                    <input type="text" name="author" class="form-control bg-light border-0" value="<?= htmlspecialchars($book->getAuthor()) ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold text-dark">Nhà xuất bản</label>
                    <input type="text" name="publisher" class="form-control border" value="<?= htmlspecialchars($book->getPublisher()) ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold text-dark">Năm xuất bản</label>
                    <input type="number" name="publish_year" class="form-control border" value="<?= htmlspecialchars($book->getPublishYear()) ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold text-dark">Số lượng kho <span class="text-danger">*</span></label>
                    <input type="number" name="quantity" class="form-control border" value="<?= htmlspecialchars($book->getQuantity()) ?>" required>
                </div>
            </div>

            <!-- Ô SỬA VÀ THAY ĐỔI ẢNH BÌA SÁCH -->
            <div class="mb-3">
                <label class="form-label fw-semibold text-dark">Ảnh bìa sách (Thay đổi ảnh mới)</label>
                
                <!-- Hiển thị ảnh hiện tại nếu có -->
                <div class="d-flex align-items-center gap-3 mb-2 p-2 bg-light rounded-3 border">
                    <div style="width: 70px; height: 95px;" class="overflow-hidden rounded border bg-white flex-shrink-0">
                        <?php if (!empty($book->getCoverImage())): ?>
                            <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($book->getCoverImage()) ?>" id="currentImg" class="w-100 h-100" style="object-fit: cover;">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                <i class="fa-solid fa-image"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <small class="fw-semibold d-block text-secondary">Ảnh hiện tại trong hệ thống</small>
                        <small class="text-muted"><?= !empty($book->getCoverImage()) ? htmlspecialchars($book->getCoverImage()) : 'Chưa có ảnh bìa' ?></small>
                    </div>
                </div>

                <!-- Input chọn ảnh mới -->
                <input type="file" name="cover_image" class="form-control border" accept="image/*" onchange="previewEditImage(event)">
                <small class="text-muted">Chọn ảnh mới từ máy tính nếu bạn muốn thay đổi. Để trống nếu muốn giữ nguyên ảnh hiện tại.</small>
                
                <!-- Khung xem trước ảnh mới chọn -->
                <div id="newPreviewBox" class="mt-3 text-center d-none">
                    <p class="text-primary small fw-semibold mb-1">Xem trước ảnh mới sẽ thay thế:</p>
                    <img id="newImgPreview" src="#" alt="Xem trước ảnh mới" class="rounded border shadow-sm" style="max-height: 180px; object-fit: cover;">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-dark">Mô tả nội dung</label>
                <textarea name="des" class="form-control border" rows="4"><?= htmlspecialchars($book->getDes()) ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-soft-blue fw-bold px-4 py-2 shadow-sm">
                    <i class="fa-solid fa-check me-2"></i>Cập nhật thông tin
                </button>
                <a href="<?= BASE_URL ?>/index.php?controller=book&action=index" class="btn btn-light px-4 py-2 border">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>

<!-- Script xem trước ảnh mới khi chọn tệp -->
<script>
function previewEditImage(event) {
    const input = event.target;
    const previewBox = document.getElementById('newPreviewBox');
    const imgPreview = document.getElementById('newImgPreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imgPreview.src = e.target.result;
            previewBox.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>