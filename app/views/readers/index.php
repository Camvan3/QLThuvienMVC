<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-header card-header-tlu d-flex justify-content-between align-items-center py-3 px-4">
        <span><i class="fa-solid fa-users me-2"></i>Quản lý Người dùng & Độc giả</span>
        <span class="badge bg-light text-primary">Thư viện TLU</span>
    </div>
    <div class="card-body">
        <!-- TÌM KIẾM ĐỘC GIẢ -->
        <form action="<?= BASE_URL ?>/index.php" method="GET" class="row g-2 mb-3">
            <input type="hidden" name="controller" value="user">
            <input type="hidden" name="action" value="index">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo Tên đăng nhập, Email hoặc Họ tên độc giả..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-magnifying-glass me-1"></i> Tìm</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">ID User</th>
                        <th>Tên đăng nhập</th>
                        <th>Email</th>
                        <th>Họ tên Độc giả</th>
                        <th>Số điện thoại</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th class="text-center pe-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($readers)): ?>
                        <?php foreach ($readers as $r): ?>
                        <tr>
                            <td class="ps-3 fw-bold"><?= $r->getIdUser() ?></td>
                            <td><span class="text-primary fw-semibold"><?= htmlspecialchars($r->getUsername()) ?></span></td>
                            <td><?= htmlspecialchars($r->getEmail()) ?></td>
                            <td><?= htmlspecialchars($r->getFullName() ?: 'Chưa cập nhật reader') ?></td>
                            <td><?= htmlspecialchars($r->getPhone() ?: '---') ?></td>
                            <td>
                                <span class="badge <?= $r->getRole() == 'admin' ? 'bg-danger' : 'bg-success' ?>">
                                    <?= $r->getRole() ?>
                                </span>
                            </td>
                            <td>
                                <!-- HIỂN THỊ TRẠNG THÁI -->
                                <span class="badge bg-success">Đang hoạt động</span>
                            </td>
                            <td class="text-center pe-3">
                                <?php if ($r->getRole() !== 'admin'): ?>
                                    <a href="<?= BASE_URL ?>/index.php?controller=user&action=delete&id=<?= $r->getIdUser() ?>" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?')" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash me-1"></i> Xóa
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">Mặc định</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-3 text-muted">Không có người dùng nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>