<?php $__env->startSection('content'); ?>
<h2>Thông tin tài khoản</h2>
<div class="row">
    <form method="POST" action="<?php echo e(route('user.info', ['user' => $user->id])); ?>" class="col-8" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="exampleInputEmail1">User name</label>
            <?php if($user->isRole('student')): ?>
                <div id="exampleInputEmail1" class="form-control" aria-describedby="emailHelp">
                    <?php echo e($user->username); ?>

                </div>
            <?php else: ?>    
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
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">New password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('password')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Re-password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation">
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
            <?php if($user->isRole('student')): ?>
                <div id="exampleInputEmail1" class="form-control" aria-describedby="emailHelp">
                    <?php echo e($user->name); ?>

                </div>
            <?php else: ?> 
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
            <?php endif; ?>
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

        <div class="form-group  ">
            <label for="userAvatar" class="form-label">Upload avatar</label>
            <input name="avatar" type="file" class="form-control" id="userAvatar" accept="image/*">
            <label for="urlAvatar" class="form-label mt-3">Url ảnh</label>
            <input name="url_avatar" type="text" class="form-control" id="urlAvatar">
            <div class="figure">
                <img style="width: 200px;" src="<?php echo e(asset('storage/avatars/'.$user->avatar)); ?>" class="my-3 rounded">
                <figcaption class="figure-caption text-center">Avatar hiện tại</figcaption>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Desktop\viettel\challenge1.2-bc-main\resources\views/block/info_user.blade.php ENDPATH**/ ?>