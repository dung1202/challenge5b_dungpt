

<?php $__env->startSection('content'); ?>
<h2>Sửa học sinh</h2>
<div class="row">
    <form method="POST" action="<?php echo e(route('user.update', ['user' => $user->id])); ?>" class="col-8">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="exampleInputEmail1">User name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" value="<?php echo e($user->username); ?>">
            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('username')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail2">Email</label>
            <input type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" name="email" value="<?php echo e($user->email); ?>">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('email')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail3">Full name</label>
            <input type="text" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" name="name" value="<?php echo e($user->name); ?>">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('name')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail4">SĐT</label>
            <input type="text" class="form-control" id="exampleInputEmail4" aria-describedby="emailHelp" name="sdt" value="<?php echo e($user->sdt); ?>">
            <?php $__errorArgs = ['sdt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('sdt')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="gender">Giới tính</label>
            <div class="col-3 row">
                <select name="gender" id="gender">
                    <option value="" disabled selected>Chọn</option>
                    <option value="1" <?php echo e($user->gender == 1 ? 'selected' : ''); ?>>Nam</option>
                    <option value="0" <?php echo e($user->gender == 0 ? 'selected' : ''); ?>>Nữ</option>
                </select>
                <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span style="color: red;"><?php echo e($errors->first('gender')); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="roles">Vai trò</label>
            <select name="roles[]" multiple class="col-12" id="roles">
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(auth()->user()->isRole('teacher') && $role->name === 'admin'): ?>
                        <?php continue; ?>
                    <?php endif; ?>
                    <option value="<?php echo e($role->id); ?>" <?php echo e($listRoles->contains($role->id) ? 'selected' : ''); ?>><?php echo e($role->display_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bluecyber_laravel-8x\resources\views/block/edit_user.blade.php ENDPATH**/ ?>