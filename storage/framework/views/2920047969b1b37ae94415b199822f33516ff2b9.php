

<?php $__env->startSection('content'); ?>
<h2>Tin nhắn của bạn</h2>
<div class="row">
    <div class="col-12">
        <h5>Tin đã gửi</h5>
        <div>
            <?php $__currentLoopData = $linkTo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $links): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="btn btn-primary" href="<?php echo e(route('messenger.create', ['user' => $links->first()->user_from])); ?>" style="max-width: 110px; min-width: 110px;">
                        <?php echo e(mb_strlen($link->messenger) > 10 ? substr($link->messenger, 0, 10) . ' ...' : $link->messenger . ' ...'); ?>

                    </a>
                    <div style="height: 14px;"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="col-12">
        <h5>Tin đã nhận</h5>
        <div>
            <?php $__currentLoopData = $linkFrom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="btn btn-primary" href="<?php echo e(route('messenger.create', ['user' => $link->user_from])); ?>" style="max-width: 110px; min-width: 110px;">
                    <?php echo e(mb_strlen($link->messenger) > 10 ? substr($link->messenger, 0, 10) . ' ...' : $link->messenger . ' ...'); ?>

                </a>
                <div style="height: 14px;"></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bluecyber_laravel-8x\resources\views/messenger/notify.blade.php ENDPATH**/ ?>