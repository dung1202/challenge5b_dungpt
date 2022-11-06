

<?php $__env->startSection('content'); ?>
<h2>Thêm trò chơi</h2>
<div class="row">
    <form method="POST" action="<?php echo e(route('game.store')); ?>" class="col-8" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Tên trò chơi</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="game_name">
            <?php $__errorArgs = ['game_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('game_name')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="exampleInputText1">Gợi ý</label>
            <textarea class="form-control shadow-none textarea" id="exampleInputText1" name="game_desc" cols="30" rows="5"></textarea>
            <?php $__errorArgs = ['game_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('game_desc')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="exampleInputFile1" style="color: #217ff3;">
                File (Nội dung là bài thơ, văn ... của đáp án, đáp án là tên file, 
                tên file được viết dưới định dạng không dấu và các từ cách nhau bởi 1 khoảng trắng) (.txt)
            </label>
            <input type="file" class="form-control" id="exampleInputFile1" name="game_file">
            <?php $__errorArgs = ['game_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('game_file')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bluecyber_laravel-8x\resources\views/game/add_game.blade.php ENDPATH**/ ?>