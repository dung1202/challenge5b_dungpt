<?php $__env->startSection('content'); ?>
<h2>Nộp bài</h2>
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
    <form method="POST" action="<?php echo e(route('submit.store', ['exercise' => request()->route()->parameter('exercise')])); ?>" class="col-8" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="exampleInputFile1">File bài tập</label>
            <input type="file" class="form-control" id="exampleInputFile1" name="submit_file[]" multiple>
            <?php $__errorArgs = ['submit_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('submit_file')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php if($errors->has('submit_file.*')): ?>
                <span style="color: red;"><?php echo e($errors->first('submit_file.*')); ?></span>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Desktop\viettel\challenge1.2-bc-main\resources\views/submit/add_submit.blade.php ENDPATH**/ ?>