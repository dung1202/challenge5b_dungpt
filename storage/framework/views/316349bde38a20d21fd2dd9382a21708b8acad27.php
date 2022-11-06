

<?php $__env->startSection('content'); ?>
<h2>Chúc mừng</h2>
<a href="<?php echo e(url('/')); ?>" class="btn btn-primary" style="margin-bottom: 20px;">Trang chủ</a>
<div class="row">
    <div class="col-12" style="color: #217ff3">
        <?php echo e($reply); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bluecyber_laravel-8x\resources\views/game/success_game.blade.php ENDPATH**/ ?>