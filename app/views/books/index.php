<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="fa-solid fa-book me-2 text-primary"></i>Quản lý Sách Thư viện
        </h5>
        
        <!-- NÚT THÊM SÁCH MỚI ĐẸP NỔI BẬT -->
        <a href="<?= BASE_URL ?>/index.php?controller=book&action=add" class="btn btn-soft-blue btn-sm px-3 py-2 shadow-sm rounded-3">
            <i class="fa-solid fa-plus me-1"></i> Thêm sách mới
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Mã sách</th>
                        <th>Ảnh bìa</th>
                        <th>Tên sách</th>
                        <th>Thể loại</th>
                        <th>Tác giả</th>
                        <th>NXB / Năm</th>
                        <th>Số lượng</th>
                        <th class="text-center pe-4">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($books)): ?>
                        <?php foreach ($books as $book): ?>
                        <tr>
                            <td class="ps-4 fw-bold"><?= $book->getIdBook() ?></td>
                            <td>
                                <div class="bg-light d-flex align-items-center justify-content-center rounded border" style="width: 40px; height: 55px;">
                                    <i class="fa-solid fa-book text-primary fs-4"></i>
                                </div>
                            </td>
                            <td class="fw-semibold text-dark"><?= htmlspecialchars($book->getTitle()) ?></td>
                            <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle"><?= htmlspecialchars($book->getCategoryName()) ?></span></td>
                            <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                            <td><span class="small text-muted"><?= htmlspecialchars($book->getPublisher()) ?> (<?= $book->getPublishYear() ?>)</span></td>
                            <td><span class="badge bg-success px-2 py-1"><?= $book->getQuantity() ?></span></td>
                            <td class="text-center pe-4">
                                <a href="<?= BASE_URL ?>/index.php?controller=book&action=edit&id=<?= $book->getIdBook() ?>" class="btn btn-warning btn-sm text-white me-1">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="<?= BASE_URL ?>/index.php?controller=book&action=delete&id=<?= $book->getIdBook() ?>" onclick="return confirm('Bạn có chắc muốn xóa cuốn sách này khỏi kho?')" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Chưa có cuốn sách nào trong kho dữ liệu.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>