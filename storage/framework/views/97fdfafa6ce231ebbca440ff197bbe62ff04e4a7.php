

<?php $__env->startSection('content'); ?>
<h2>Thêm học sinh</h2>
<div class="row">
    <form method="POST" action="<?php echo e(route('exercise.store')); ?>" class="col-8" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Tên bài tập</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="exercise_name">
            <?php $__errorArgs = ['exercise_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('exercise_name')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="exampleInputText1">Mô tả</label>
            <textarea class="form-control shadow-none textarea" id="exampleInputText1" name="description" cols="30" rows="5"></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('description')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="exampleInputFile1">File bài tập</label>
            <input type="file" class="form-control" id="exampleInputFile1" name="exercise_file[]" multiple>
            <?php $__errorArgs = ['exercise_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('exercise_file')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php if($errors->has('exercise_file.*')): ?>
                <span style="color: red;"><?php echo e($errors->first('exercise_file.*')); ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="students">Học sinh nhận bài</label>
            <select name="students[]" multiple class="col-12" id="students">
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($student->id); ?>"><?php echo e($student->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bluecyber_laravel-8x\resources\views/exercise/add_exercise.blade.php ENDPATH**/ ?>