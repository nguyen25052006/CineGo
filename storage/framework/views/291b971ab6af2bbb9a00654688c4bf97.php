<?php $__env->startSection('title', 'CineGo - Trang Chủ Đặt Vé Xem Phim'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- BANNER HERO -->
    <div class="p-5 mb-5 rounded-4 text-white shadow" style="background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.9)), url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?q=80&w=1200') center/cover;">
        <div class="col-md-8 py-3">
            <h1 class="display-4 fw-bold text-warning">Trải Nghiệm Điện Ảnh Đỉnh Cao</h1>
            <p class="lead mb-4">Khám phá hàng loạt bom tấn mới nhất tại rạp cùng CineGo. Đặt vé giữ chỗ trong nháy mắt!</p>
            <a href="<?php echo e(route('movies.index')); ?>" class="btn btn-cinego btn-lg px-4 shadow">
                <i class="bi bi-ticket-detailed me-2"></i>Đặt vé ngay
            </a>
        </div>
    </div>

    <!-- MỤC PHIM ĐANG CHIẾU -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold border-start border-4 border-danger ps-3 mb-0">Phim Đang Chiếu</h3>
        <a href="<?php echo e(url('/movies')); ?>" class="text-warning text-decoration-none small fw-bold">Xem tất cả <i class="bi bi-chevron-right"></i></a>
    </div>

  
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mb-5">

        <?php $__empty_1 = true; $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <div class="col">
            <div class="card card-custom h-100 rounded-3 overflow-hidden">

                <img
                    src="<?php echo e($movie->poster ?: 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=500'); ?>"
                    class="card-img-top"
                    alt="<?php echo e($movie->title); ?>"
                    style="height: 320px; object-fit: cover;">

                <div class="card-body d-flex flex-column">

                    <span class="badge bg-danger mb-2 align-self-start">
                        <?php echo e($movie->genre); ?>

                    </span>

                    <h5 class="card-title fw-bold text-truncate">
                        <?php echo e($movie->title); ?>

                    </h5>

                    <p class="card-text text-secondary small mb-3">
                        <i class="bi bi-clock me-1"></i>
                        <?php echo e($movie->duration_minutes); ?> phút
                    </p>

                    <a
                        href="<?php echo e(route('movies.show', $movie->id)); ?>"
                        class="btn btn-sm btn-outline-light mt-auto">
                        Xem Chi Tiết
                    </a>

                </div>
            </div>
        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <div class="col-12 text-center py-4">
            <p class="text-secondary">
                Hiện chưa có phim nào đang chiếu.
            </p>

            <a href="<?php echo e(route('movies.index')); ?>"
                class="btn btn-outline-light">
                Xem danh sách phim
            </a>
        </div>

        <?php endif; ?>

    </div>


</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CineGo\resources\views/home.blade.php ENDPATH**/ ?>