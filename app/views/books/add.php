<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white col-md-8 mx-auto">
    <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-plus me-2"></i>Thêm cuốn sách mới</h4>
    
    <!-- LƯU Ý: Bắt buộc phải có enctype="multipart/form-data" để gửi file ảnh -->
    <form action="<?= BASE_URL ?>/index.php?controller=book&action=add" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label fw-semibold">Tên sách *</label>
            <input type="text" name="title" class="form-control" placeholder="Nhập tên cuốn sách..." required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Thể loại *</label>
                <select name="id_category" class="form-select" required>
                    <option value="">-- Chọn thể loại --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat->getIdCategory() ?>"><?= htmlspecialchars($cat->getNameCategory()) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Tác giả *</label>
                <input type="text" name="author" class="form-control" placeholder="Nhập tên tác giả..." required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Nhà xuất bản</label>
                <input type="text" name="publisher" class="form-control" placeholder="NXB...">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Năm xuất bản</label>
                <input type="number" name="publish_year" class="form-control" value="2026">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Số lượng *</label>
                <input type="number" name="quantity" class="form-control" value="1" required>
            </div>
        </div>

        <!-- Ô TẢI ẢNH TRỰC TIẾP TỪ MÁY TÍNH -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Ảnh bìa sách (Upload từ máy tính)</label>
            <input type="file" name="cover_image" id="coverInput" class="form-control" accept="image/*" onchange="previewImage(event)">
            <small class="text-muted">Chọn file ảnh (.jpg, .png, .jpeg) trực tiếp từ thiết bị của bạn.</small>
            
            <!-- Khung hiển thị xem trước ảnh ngay sau khi chọn -->
            <div id="previewBox" class="mt-3 text-center d-none">
                <p class="text-muted small mb-1">Ảnh xem trước:</p>
                <img id="imgPreview" src="#" alt="Xem trước ảnh" class="rounded border shadow-sm" style="max-height: 180px;">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Mô tả nội dung</label>
            <textarea name="des" class="form-control" rows="3" placeholder="Tóm tắt ngắn gọn nội dung cuốn sách..."></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-soft-blue fw-bold px-4">Lưu cuốn sách</button>
            <a href="<?= BASE_URL ?>/index.php?controller=book&action=index" class="btn btn-light px-4">Hủy bỏ</a>
        </div>
    </form>
</div>

<!-- Script xem trước ảnh trực tiếp trên form -->
<script>
function previewImage(event) {
    const input = event.target;
    const previewBox = document.getElementById('previewBox');
    const imgPreview = document.getElementById('imgPreview');

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