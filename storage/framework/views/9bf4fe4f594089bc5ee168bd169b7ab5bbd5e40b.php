<?php $__env->startSection('content'); ?>
<h2>Danh sách học sinh</h2>
<a href="<?php echo e(route('role.create')); ?>" class="btn btn-primary" style="margin-bottom: 20px;">Add user</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Name</th>
            <th scope="col">Display name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($loop->index + 1); ?></th>
                <td><?php echo e($role->name); ?></td>
                <td><?php echo e($role->display_name); ?></td>
                <td>
                    <a href="<?php echo e(route('role.edit', ['role' => $role->id])); ?>" class="btn btn-success">Edit</a>
                    <a onclick="return confirm('Bạn có muốn xoá?');" href="<?php echo e(route('role.destroy', ['role' => $role->id])); ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Desktop\viettel\challenge1.2-bc-main\resources\views/block/view_role.blade.php ENDPATH**/ ?>