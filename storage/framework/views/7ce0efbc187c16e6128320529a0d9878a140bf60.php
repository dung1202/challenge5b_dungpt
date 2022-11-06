<?php $__env->startSection('content'); ?>
<h2>Sửa học sinh</h2>
<div class="row">
    <form method="POST" action="<?php echo e(route('role.update', ['role' => $role->id])); ?>" class="col-8">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="<?php echo e($role->name); ?>">
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
            <label for="exampleInputEmail2">Display name</label>
            <input type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" name="display_name" value="<?php echo e($role->display_name); ?>">
            <?php $__errorArgs = ['display_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: red;"><?php echo e($errors->first('display_name')); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="">Quyền nhân viên</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="checkAll" 
                    <?php echo e($listPermissionsOfRole->diff($listPermissions)->isEmpty() ? 'checked' : ''); ?>> Check All
                </label>
            </div>
            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="check" name="permissions[]" 
                        value="<?php echo e($permission->id); ?>"
                        <?php echo e($listPermissions->contains($permission->id) ? 'checked' : ''); ?>

                        > <?php echo e($permission->display_name); ?>

                    </label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Desktop\viettel\challenge1.2-bc-main\resources\views/block/edit_role.blade.php ENDPATH**/ ?>