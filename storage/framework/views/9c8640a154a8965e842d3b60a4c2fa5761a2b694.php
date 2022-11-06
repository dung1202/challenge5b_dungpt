

<?php $__env->startSection('content'); ?>
<h2>Danh sách bài tập</h2>
<?php if(auth()->user()->isRole('teacher')): ?>
    <a href="<?php echo e(route('exercise.create')); ?>" class="btn btn-primary" style="margin-bottom: 20px;">Giao bài</a>
    <a href="<?php echo e(route('game.create')); ?>" class="btn btn-primary" style="margin-bottom: 20px;">Trò chơi đoán chữ</a>
<?php endif; ?>
<?php if($exercises->isEmpty()): ?>
    <span style="color: red; margin: -5px 0 5px 0; display: block;">Chưa tạo bài tập</span>
<?php else: ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên bài tập</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $exercises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exercise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th scope="row"><?php echo e($loop->index + 1); ?></th>
            <td><?php echo e($exercise->name); ?></td>
            <td><?php echo e($exercise->description); ?></td>
            <td>
                <?php if(!auth()->user()->isRole('student')): ?>
                    <a href="<?php echo e(route('exercise.show', ['id' => $exercise->id])); ?>" class="btn btn-success">Detail</a>
                    <a href="<?php echo e(route('exercise.edit', ['id' => $exercise->id])); ?>" class="btn btn-success">Edit</a>
                    <a onclick="return confirm('Bạn có muốn xoá?');" href="<?php echo e(route('exercise.destroy', ['id' => $exercise->id])); ?>" class="btn btn-danger">Delete</a>
                <?php endif; ?>
                <?php if(!auth()->user()->isRole('student')): ?>
                    <?php continue; ?>
                <?php endif; ?>
                <a href="<?php echo e(route('submit.create', ['exercise' => $exercise->id])); ?>" class="btn btn-primary">Trả bài</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php endif; ?>
<h2>Danh sách trò chơi</h2>
<?php if($games->isEmpty()): ?>
    <span style="color: red; margin: -5px 0 5px 0; display: block;">Chưa tạo trò chơi</span>
<?php else: ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên trò chơi</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($loop->index + 1); ?></th>
                <td><?php echo e($game->name); ?></td>
                <td>
                    <a href="<?php echo e(route('game.show', ['id' => $game->id])); ?>" class="btn btn-success">Chơi</a>
                    <?php if(!auth()->user()->isRole('student')): ?>
                    <a onclick="return confirm('Bạn có muốn xoá?');" href="<?php echo e(route('game.destroy', ['id' => $game->id])); ?>" class="btn btn-danger">Delete</a>
                        <?php if(!auth()->user()->isRole('teacher')): ?>
                            <?php continue; ?>
                        <?php endif; ?>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="<?php echo e('#game' . $game->id); ?>">
                            Show gợi ý
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="<?php echo e('game' . $game->id); ?>" tabindex="-1"
                            aria-labelledby="exampleModalCenteredScrollableTitle" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('game.update', ['id' => $game->id])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenteredScrollableTitle"><?php echo e($game->name); ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <h5>Gợi ý</h5>
                                                <textarea class="form-control shadow-none textarea" name="hint"><?php echo e($game->description); ?></textarea>
                                            </div>
                                            <div class="col-12 form-group">
                                                <h5>Đáp án (Viết hoa / thường / không dấu đều chính xác)</h5>
                                                <input type="text" class="form-control" name="result" value="<?php echo e($game->result); ?>">
                                            </div>
                                            <div class="col-12">
                                                <h5>Nội dung</h5>
                                                <textarea class="form-control shadow-none textarea" name="content"><?php echo e($game->game_content); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php $__errorArgs = ['hint'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span style="color: "><?php echo e($errors->first('hint')); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span style="color: "><?php echo e($errors->first('content')); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php endif; ?>
<h2>Danh sách học sinh</h2>
<?php if(auth()->check() && !auth()->user()->isRole('student')): ?>
    <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary" style="margin-bottom: 20px;">Add user</a>
<?php endif; ?>
<?php if($users->isEmpty()): ?>
    <span style="color: red; margin: -5px 0 5px 0; display: block;">Chưa tạo user</span>
<?php else: ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">User name</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Email</th>
            <th scope="col">SĐT</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
        ?>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(auth()->user()->isRole('student') && $user->isRole('admin') || $user->id === auth()->user()->id): ?>
                <?php continue; ?>
            <?php endif; ?>
            <tr>
                <th scope="row"><?php echo e($i); ?></th>
                <td>
                    <?php echo e($user->username); ?>

                    <br>
                    <span style="color: red;">(<?php echo e($user->roles()->first()->display_name); ?>)</span>
                </td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->gender == 0 ? 'Nữ' : 'Nam'); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->sdt); ?></td>
                <td>
                    <?php if( auth()->check() && !auth()->user()->isRole('student') ): ?>
                        <?php if( !$user->isRole('student') && auth()->user()->isRole('teacher') ): ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('user.edit', ['user' => $user->id])); ?>" class="btn btn-success">Edit</a>
                            <a onclick="return confirm('Bạn có muốn xoá?');" href="<?php echo e(route('user.destroy', ['user' => $user->id])); ?>" class="btn btn-danger">Delete</a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a href="<?php echo e(route('messenger.create', ['user' => $user->id])); ?>" class="btn btn-primary">Mesenger</a>
                </td>
            </tr>
            <?php
                $i ++;
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bluecyber_laravel-8x\resources\views/block/view_user.blade.php ENDPATH**/ ?>