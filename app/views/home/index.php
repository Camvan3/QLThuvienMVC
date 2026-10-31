<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<!-- BANNER CHÀO MỪNG XANH DỊU PASTEL -->
<div class="banner-pastel mb-4 shadow-sm">
    <span class="badge bg-white text-primary rounded-pill px-3 py-2 mb-3 fw-semibold">THƯ VIỆN TRỰC TUYẾN THỦY LỢI</span>
    <h2 class="fw-bold mb-2">Xin chào, <?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['username']) : 'Thành viên' ?>!</h2>
    <p class="mb-2 opacity-90">Chào mừng bạn đến với thư viện trực tuyến Đại học Thủy Lợi.</p>
    <small class="opacity-75">Tài khoản: <?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['username']) : 'khách' ?></small>
</div>

<!-- THANH TÌM KIẾM SÁCH & BỘ LỌC THỂ LOẠI -->
<div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
    <form action="<?= BASE_URL ?>/index.php" method="GET" class="row g-2 align-items-center">
        <input type="hidden" name="controller" value="home">
        
        <div class="col-md-7">
            <div class="input-group">
                <span class="input-group-text bg-light border-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                <input type="text" name="keyword" class="form-control bg-light border-0" 
                       placeholder="Nhập tên sách hoặc tên tác giả..." 
                       value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
            </div>
        </div>

        <div class="col-md-3">
            <select name="category_id" class="form-select bg-light border-0">
                <option value="">-- Tất cả thể loại --</option>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat->getIdCategory() ?>" <?= (isset($_GET['category_id']) && $_GET['category_id'] == $cat->getIdCategory()) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat->getNameCategory()) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="col-md-2 d-flex gap-1">
            <button type="submit" class="btn btn-soft-blue w-100 fw-bold">
                <i class="fa-solid fa-search me-1"></i> Tìm
            </button>
            <?php if (!empty($_GET['keyword']) || !empty($_GET['category_id'])): ?>
                <a href="<?= BASE_URL ?>/index.php?controller=home" class="btn btn-light border" title="Xóa bộ lọc">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- KHÁM PHÁ KHO SÁCH -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="fw-bold text-dark mb-1">Khám phá kho sách</h4>
        <p class="text-muted small mb-0">Những cuốn sách nổi bật tại thư viện</p>
    </div>
    <a href="<?= BASE_URL ?>/index.php?controller=home" class="text-decoration-none text-primary fw-semibold small">Xem tất cả &rarr;</a>
</div>

<!-- DANH SÁCH SÁCH -->
<div class="row g-4">
    <?php if (!empty($books)): ?>
        <?php foreach ($books as $book): ?>
        <div class="col-md-3 col-sm-6">
            <div class="card book-card h-100 p-3">
                
                <!-- KHUNG HÌNH CHỮ NHẬT DỌC -->
                <div class="book-img-placeholder mb-3">
                    <?php 
                        $imgName = $book->getCoverImage();
                        // Đường dẫn vật lý đến thư mục chứa ảnh trên ổ đĩa
                        $physicalPath = APP_ROOT . '/../public/uploads/' . $imgName;

                        // Chỉ hiển thị ảnh nếu tên tệp không rỗng VÀ tệp có tồn tại trên máy
                        if (!empty($imgName) && file_exists($physicalPath)): 
                    ?>
                        <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($imgName) ?>" 
                             alt="<?= htmlspecialchars($book->getTitle()) ?>" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <!-- Giao diện mặc định khi chưa có ảnh hoặc file bị mất -->
                        <div class="d-flex flex-column align-items-center justify-content-center h-100 py-4 text-center px-2">
                            <i class="fa-solid fa-book-open fs-2 mb-2 text-primary"></i>
                            <span class="text-primary small fw-semibold"><?= htmlspecialchars($book->getTitle()) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="card-body p-0 d-flex flex-column">
                    <small class="text-primary fw-semibold mb-1"><?= htmlspecialchars($book->getCategoryName() ?? 'Thể loại khác') ?></small>
                    <h5 class="fw-bold text-dark mb-1" style="font-size: 1rem;"><?= htmlspecialchars($book->getTitle()) ?></h5>
                    <p class="text-muted small mb-3">Tác giả: <?= htmlspecialchars($book->getAuthor() ?? 'Đang cập nhật') ?></p>
                    
                    <div class="mt-auto">
                        <a href="<?= BASE_URL ?>/index.php?controller=home&action=detail&id=<?= $book->getIdBook() ?>" class="btn btn-soft-blue btn-sm w-100">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-light text-center py-4 border rounded-3 text-muted">Không tìm thấy cuốn sách nào phù hợp.</div>
        </div>
    <?php endif; ?>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>