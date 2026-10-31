<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="fa-solid fa-layer-group me-2 text-primary"></i>Quản lý Thể loại
        </h5>
        
        <!-- NÚT THÊM THỂ LOẠI ĐẸP NỔI BẬT -->
        <a href="<?= BASE_URL ?>/index.php?controller=category&action=add" class="btn btn-soft-blue btn-sm px-3 py-2 shadow-sm rounded-3">
            <i class="fa-solid fa-plus me-1"></i> Thêm thể loại
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Tên thể loại</th>
                    <th>Mô tả</th>
                    <th class="text-center pe-4">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td class="ps-4 fw-bold"><?= $cat->getIdCategory() ?></td>
                   <td class="fw-semibold text-primary"><?= htmlspecialchars($cat->getNameCategory()) ?></td>
                    <td><?= htmlspecialchars($cat->getDes()) ?></td>
                    <td class="text-center pe-4">
                        <a href="<?= BASE_URL ?>/index.php?controller=category&action=edit&id=<?= $cat->getIdCategory() ?>" class="btn btn-warning btn-sm text-white"><i class="fa-solid fa-pen"></i></a>
                        <a href="<?= BASE_URL ?>/index.php?controller=category&action=delete&id=<?= $cat->getIdCategory() ?>" onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>