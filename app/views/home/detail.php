<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="mb-3">
    <a href="<?= BASE_URL ?>/index.php?controller=home" class="btn btn-outline-secondary btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Quay lại trang chủ
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-book-bookmark me-2"></i>Chi tiết cuốn sách</h5>
    </div>
    
    <div class="card-body p-4">
        <div class="row g-4">
            <!-- KHUNG HIỂN THỊ ẢNH BÌA SÁCH BÊN TRÁI -->
            <div class="col-md-4">
                <div class="bg-light rounded-4 d-flex align-items-center justify-content-center overflow-hidden border" style="min-height: 320px; max-height: 400px;">
                    <?php 
                        $imgName = $book->getCoverImage();
                        $imgPath = APP_ROOT . '/../public/uploads/' . $imgName;
                        if (!empty($imgName) && file_exists($imgPath)): 
                    ?>
                        <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($imgName) ?>" 
                             alt="<?= htmlspecialchars($book->getTitle()) ?>" 
                             class="img-fluid w-100 h-100" 
                             style="object-fit: cover;">
                    <?php else: ?>
                        <!-- Icon mặc định nếu chưa có ảnh -->
                        <i class="fa-solid fa-book-open text-primary" style="font-size: 5rem;"></i>
                    <?php endif; ?>
                </div>
            </div>

            <!-- THÔNG TIN CHI TIẾT BÊN PHẢI -->
            <div class="col-md-8">
                <h3 class="fw-bold text-dark mb-2"><?= htmlspecialchars($book->getTitle()) ?></h3>
                <p class="text-primary fw-semibold mb-3">
                    <i class="fa-solid fa-user-pen me-1"></i>Tác giả: <?= htmlspecialchars($book->getAuthor() ?? 'Đang cập nhật') ?>
                </p>
                <hr class="my-3 opacity-25">

                <div class="mb-3">
                    <span class="fw-bold me-2">Thể loại:</span>
                    <span class="badge bg-info text-dark px-3 py-2 fw-semibold"><?= htmlspecialchars($book->getCategoryName() ?? 'Chưa phân loại') ?></span>
                </div>

                <div class="mb-2">
                    <span class="fw-bold me-2">Nhà xuất bản:</span>
                    <span class="text-secondary"><?= htmlspecialchars($book->getPublisher() ?? 'Đang cập nhật') ?></span>
                </div>

                <div class="mb-3">
                    <span class="fw-bold me-2">Năm xuất bản:</span>
                    <span class="text-secondary"><?= htmlspecialchars($book->getPublishYear() ?? 'Đang cập nhật') ?></span>
                </div>

                <div class="mb-4">
                    <span class="fw-bold me-2">Số lượng còn lại trong kho:</span>
                    <span class="badge bg-success px-3 py-2 fw-semibold"><?= htmlspecialchars($book->getQuantity()) ?> cuốn</span>
                </div>

                <div>
                    <h6 class="fw-bold text-dark mb-2">Mô tả nội dung:</h6>
                    <p class="text-secondary lh-lg mb-0"><?= nl2br(htmlspecialchars($book->getDes() ?? 'Chưa có mô tả cho cuốn sách này.')) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>