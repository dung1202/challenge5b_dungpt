<?php $__env->startSection('content'); ?>
<h2>Chi tiết bài tập</h2>
<div class="row">
    <div class="col-12">
        <span>Tên bài: </span><span><?php echo e($exercise->name); ?></span>
    </div>
    <div class="col-12">
        <span>Mô tả: </span><span><?php echo e($exercise->description); ?></span>
    </div>
    <div class="col-12">
        <span>Đề bài</span>
        <?php $__currentLoopData = $exercise->file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(asset($item)); ?>" style="display: block;">Xem trực tiếp</a>
            <a href=<?php echo e("../../". $item); ?> download>Tải xuống đề bài</a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="col-12">
        <h2>Học sinh nộp bài</h2>
        <?php $__currentLoopData = $submits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $submit->file_submit = json_decode($submit->file_submit, true);
            ?>
            <div class="row">
                <div class="col-12">
                    <span>Học sinh: </span><?php echo e($submit->user()->first()->name); ?>

                    <?php $__currentLoopData = $submit->file_submit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(asset($item)); ?>" style="display: block;">Xem trực tiếp</a>
                        <a href=<?php echo e("../../". $item); ?> download>Tải xuống đề bài</a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Desktop\viettel\challenge1.2-bc-main\resources\views/exercise/show_exercise.blade.php ENDPATH**/ ?>