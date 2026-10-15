<?php $__env->startSection('title', 'Thêm phim mới | CineGo'); ?>
<?php $__env->startSection('page_title', 'Thêm phim mới'); ?>

<?php $__env->startSection('content'); ?>

    <!-- TIÊU ĐỀ -->
    <div class="d-flex flex-wrap justify-content-between
                align-items-center gap-3 mb-4">

        <div>
            <div class="page-label">Thư viện phim</div>

            <h2 class="page-heading">Thêm phim mới</h2>

            <p class="page-description">
                Điền thông tin để đưa phim vào hệ thống CineGo.
            </p>
        </div>

        <a href="<?php echo e(route('admin.movies.index')); ?>"
           class="btn-admin-light">

            <i class="bi bi-arrow-left"></i>
            Quay lại danh sách

        </a>

    </div>


    <!-- FORM THÊM PHIM -->
    <div class="admin-card overflow-hidden">

        <div class="p-3 p-md-4 border-bottom">

            <h5 class="fw-bold mb-1">
                <i class="bi bi-camera-reels me-2"
                   style="color:#e11d48;"></i>
                Thông tin phim
            </h5>

            <p class="text-secondary small mb-0">
                Những trường có dấu
                <span class="text-danger">*</span>
                là bắt buộc.
            </p>

        </div>


        <form action="<?php echo e(route('admin.movies.store')); ?>"
              method="POST">

            <?php echo csrf_field(); ?>

            <div class="p-3 p-md-4">

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger rounded-3">
                        <strong>Vui lòng kiểm tra lại thông tin.</strong>

                        <ul class="mb-0 mt-2">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>


                <!-- TÊN PHIM -->
                <div class="mb-4">

                    <label for="title" class="form-label fw-bold">
                        Tên phim <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        value="<?php echo e(old('title')); ?>"
                        placeholder="Ví dụ: Đào, Phở và Piano"
                        required
                    >

                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>


                <!-- THỂ LOẠI VÀ THỜI LƯỢNG -->
                <div class="row g-3 mb-4">

                    <div class="col-12 col-md-6">

                        <label for="genre" class="form-label fw-bold">
                            Thể loại <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="genre"
                            name="genre"
                            class="form-control <?php $__errorArgs = ['genre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('genre')); ?>"
                            placeholder="Hành động, Tình cảm..."
                            required
                        >

                        <?php $__errorArgs = ['genre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>


                    <div class="col-12 col-md-6">

                        <label for="duration_minutes"
                               class="form-label fw-bold">

                            Thời lượng (phút)
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="number"
                            id="duration_minutes"
                            name="duration_minutes"
                            class="form-control <?php $__errorArgs = ['duration_minutes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('duration_minutes')); ?>"
                            placeholder="120"
                            min="1"
                            required
                        >

                        <?php $__errorArgs = ['duration_minutes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                </div>


                <!-- NGÀY PHÁT HÀNH VÀ TRẠNG THÁI -->
                <div class="row g-3 mb-4">

                    <div class="col-12 col-md-6">

                        <label for="release_date"
                               class="form-label fw-bold">

                            Ngày phát hành
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="date"
                            id="release_date"
                            name="release_date"
                            class="form-control <?php $__errorArgs = ['release_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('release_date')); ?>"
                            required
                        >

                        <?php $__errorArgs = ['release_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>


                    <div class="col-12 col-md-6">

                        <label for="status" class="form-label fw-bold">
                            Trạng thái <span class="text-danger">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required
                        >

                            <option value="showing"
                                <?php echo e(old('status', 'showing') == 'showing' ? 'selected' : ''); ?>>
                                Đang chiếu
                            </option>

                            <option value="coming_soon"
                                <?php echo e(old('status') == 'coming_soon' ? 'selected' : ''); ?>>
                                Sắp chiếu
                            </option>

                            <option value="ended"
                                <?php echo e(old('status') == 'ended' ? 'selected' : ''); ?>>
                                Đã kết thúc
                            </option>

                        </select>

                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                </div>


                <!-- POSTER -->
                <div class="mb-4">

                    <label for="poster" class="form-label fw-bold">
                        Đường dẫn ảnh poster
                    </label>

                    <input
                        type="text"
                        id="poster"
                        name="poster"
                        class="form-control <?php $__errorArgs = ['poster'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        value="<?php echo e(old('poster')); ?>"
                        placeholder="https://example.com/poster.jpg"
                    >

                    <div class="form-text">
                        Nhập URL ảnh poster. Để trống nếu chưa có ảnh.
                    </div>

                    <?php $__errorArgs = ['poster'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>


                <!-- MÔ TẢ -->
                <div class="mb-4">

                    <label for="description" class="form-label fw-bold">
                        Nội dung phim <span class="text-danger">*</span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        placeholder="Nhập tóm tắt nội dung phim..."
                        required
                    ><?php echo e(old('description')); ?></textarea>

                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>


                <!-- NÚT LƯU -->
                <div class="d-flex flex-wrap justify-content-end
                            gap-2 pt-3 border-top">

                    <a href="<?php echo e(route('admin.movies.index')); ?>"
                       class="btn-admin-light">

                        Hủy bỏ

                    </a>

                    <button type="submit" class="btn-cinego">

                        <i class="bi bi-check-lg"></i>
                        Lưu phim

                    </button>

                </div>

            </div>

        </form>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\CineGo\resources\views/admin/movies/index.blade.php ENDPATH**/ ?>