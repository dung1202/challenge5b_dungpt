<?php $__env->startSection('content'); ?>
<?php
    function call($children, $messAdd=[]){
        $empty = [];
        $messDb = new \Illuminate\Database\Eloquent\Collection([]);
        $check = empty($messAdd) ? true : false;
        $messAdd = $check ? $children : $messAdd;
        foreach ($messAdd as $km => $messengerChildren) {
            foreach ($messengerChildren->messengerHasChildren()->get() as $k => $v) {
                $messDb->push($v);
                $id = $messengerChildren->id;
                $start = $children->search(function($i) use($id) {
                    return $i->id === $id;
                });

                $children->splice($start + 1 + $k, 0, [$v]);
                if (!$v->messengerHasChildren()->get()->isEmpty()) {
                    $empty[] = $v->id;
                }
            }
        }
        if (empty($empty)) {
            return $children;
        }
        return call($children, $messDb);
    }
?>
<div class="d-flex justify-content-center row">
<?php $__currentLoopData = $messengers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messenger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-8">
        <div class="d-flex flex-column comment-section" id="<?php echo e('myGroup' . $messenger->id); ?>">
            <div class="bg-white p-2">
                 <div class="d-flex flex-row user-info">
                    <div class="d-flex flex-column justify-content-start ml-2">
                        <span class="d-block font-weight-bold name"><?php echo e($messenger->userTo()->first()->name); ?></span>
                        <span class="date text-black-50"> <?php echo e($messenger->updated_at); ?></span>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="comment-text"><?php echo e($messenger->messenger); ?></p>
                </div>
            </div>
            <div class="bg-white p-2">
                <div class="d-flex flex-row fs-12">
                    <div class="like p-2 cursor">
                        <i class="fa fa-thumbs-o-up"></i>
                        <span class="ml-1">Like</span>
                    </div>
                    <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" 
                    aria-controls="<?php echo e('collapse-' . $messenger->id); ?>" 
                    href="<?php echo e('#collapse-' . $messenger->id); ?>">
                        <i class="fa fa-commenting-o"></i>
                        <span class="ml-1">Comment</span>
                    </div>
                    
                    <?php if(auth()->user()->id == $messenger->user_to): ?>
                        <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" 
                        aria-controls="<?php echo e('edit-collapse-' . $messenger->id); ?>" 
                        href="<?php echo e('#edit-collapse-' . $messenger->id); ?>"
                        href-link="<?php echo e(route('messenger.edit', ['mess' => $messenger->id])); ?>"
                        onclick="editToAjax(this, <?php echo e($messenger->id); ?>, '<?php echo e('edit-collapse-' . $messenger->id); ?>')">
                            <i class="fa fa-share"></i>
                            <span class="ml-1">Edit</span>
                        </div>
                        <div class="like p-2 cursor">
                            <i class="fa fa-thumbs-o-up"></i>
                            <span class="ml-1"><a onclick="return confirm('Bạn muốn xoá tin nhắn?');" href="<?php echo e(route('messenger.delete', ['mess' => $messenger->id])); ?>">Delete</a></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div id="<?php echo e('collapse-' . $messenger->id); ?>" class="bg-light p-2 collapse" data-parent="<?php echo e('#myGroup' . $messenger->id); ?>">
                <form action="<?php echo e(route('messenger.store', ['user' => $messenger->userTo()->first()->id, 'mess' => $messenger->id,])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex flex-row align-items-start">
                        
                        <textarea class="form-control ml-1 shadow-none textarea" name="messenger"></textarea>
                    </div>
                    <?php $__errorArgs = ['messenger'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red; margin-left: 40px;"><?php echo e($errors->first('messenger')); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="mt-2 text-right">
                        <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                    </div>
                </form>
            </div>
            <?php if(auth()->user()->id == $messenger->user_to || auth()->user()->isRole('admin')
            || ( auth()->user()->isRole('teacher') && $messenger->userTo()->first()->isRole('student') )): ?>
                <div id="<?php echo e('edit-collapse-' . $messenger->id); ?>" class="bg-light p-2 collapse" data-parent="<?php echo e('#myGroup' . $messenger->id); ?>">
                    <form action="<?php echo e(route('messenger.update', ['mess' => $messenger->id,])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="d-flex flex-row align-items-start">
                            
                            <textarea class="form-control ml-1 shadow-none textarea" name="messenger"></textarea>
                        </div>
                        <?php $__errorArgs = ['messenger'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span style="color: red; margin-left: 40px;"><?php echo e($errors->first('messenger')); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="mt-2 text-right">
                            <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                            <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        <?php if(!$messenger->messengerHasChildren()->get()->isEmpty()): ?>
            <?php
                $messengerChildrens = $messenger->messengerHasChildren()->get();
                $messengerChildrens = call($messengerChildrens);
            ?>
            <?php $__currentLoopData = $messengerChildrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messengerChildren): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex flex-column comment-section" id="<?php echo e('myGroup' . $messengerChildren->id); ?>" style="padding-left: 60px; background: white;">
                    <div class="bg-white p-2">
                         <div class="d-flex flex-row user-info">
                            <div class="d-flex flex-column justify-content-start ml-2">
                                <span class="d-block font-weight-bold name"><?php echo e($messengerChildren->userTo()->first()->name); ?></span>
                                <span class="date text-black-50"><?php echo e($messenger->updated_at); ?></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="comment-text">
                                <a href=""><?php echo e($messengerChildren->userFrom()->first()->name); ?></a>
                                <?php echo e($messengerChildren->messenger); ?>

                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-2">
                        <div class="d-flex flex-row fs-12">
                            <div class="like p-2 cursor">
                                <i class="fa fa-thumbs-o-up"></i>
                                <span class="ml-1">Like</span>
                            </div>
                            <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" 
                            aria-controls="<?php echo e('collapse-' . $messengerChildren->id); ?>" 
                            href="<?php echo e('#collapse-' . $messengerChildren->id); ?>">
                                <i class="fa fa-commenting-o"></i>
                                <span class="ml-1">Comment</span>
                            </div>
                            <?php if(auth()->user()->id == $messengerChildren->user_to || auth()->user()->isRole('admin')
                            || ( auth()->user()->isRole('teacher') && $messenger->userTo()->first()->isRole('student') )): ?> 
                                <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" 
                                aria-controls="<?php echo e('edit-collapse-' . $messengerChildren->id); ?>" 
                                href-link="<?php echo e(route('messenger.edit', ['mess' => $messengerChildren->id])); ?>"
                                href="<?php echo e('#edit-collapse-' . $messengerChildren->id); ?>"
                                onclick="editToAjax(this, <?php echo e($messengerChildren->id); ?>, '<?php echo e('edit-collapse-' . $messengerChildren->id); ?>')">
                                    <i class="fa fa-share"></i>
                                    <span class="ml-1">Edit</span>
                                </div>
                                <div class="like p-2 cursor">
                                    <i class="fa fa-thumbs-o-up"></i>
                                    <span class="ml-1"><a onclick="return confirm('Bạn muốn xoá tin nhắn?');" href="<?php echo e(route('messenger.delete', ['mess' => $messengerChildren->id])); ?>">Delete</a></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="<?php echo e('collapse-' . $messengerChildren->id); ?>" class="bg-light p-2 collapse" data-parent="<?php echo e('#myGroup' . $messengerChildren->id); ?>">
                        <form action="<?php echo e(route('messenger.store', ['user' => $messengerChildren->userTo()->first()->id, 'mess' => $messengerChildren->id,])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="d-flex flex-row align-items-start">
                                
                                <textarea class="form-control ml-1 shadow-none textarea" name="messenger"></textarea>
                            </div>
                            <?php $__errorArgs = ['messenger'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span style="color: red; margin-left: 40px;"><?php echo e($errors->first('messenger')); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="mt-2 text-right">
                                <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <?php if(auth()->user()->id == $messengerChildren->user_to || auth()->user()->isRole('admin')
                    || ( auth()->user()->isRole('teacher') && $messenger->userTo()->first()->isRole('student') )): ?>
                        <div id="<?php echo e('edit-collapse-' . $messengerChildren->id); ?>" class="bg-light p-2 collapse" data-parent="<?php echo e('#myGroup' . $messengerChildren->id); ?>">
                            <form action="<?php echo e(route('messenger.update', ['mess' => $messengerChildren->id,])); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="d-flex flex-row align-items-start">
                                    
                                    <textarea class="form-control ml-1 shadow-none textarea" name="messenger"></textarea>
                                </div>
                                <?php $__errorArgs = ['messenger'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span style="color: red; margin-left: 40px;"><?php echo e($errors->first('messenger')); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="mt-2 text-right">
                                    <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                                    <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-8">
        <div class="d-flex flex-column comment-section">
            <div class="bg-light p-2">
                <form action="<?php echo e(route('messenger.store', ['user' => request()->route()->parameter('user')])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex flex-row align-items-start">
                        
                        <textarea class="form-control ml-1 shadow-none textarea" name="messenger"></textarea>
                    </div>
                    <?php $__errorArgs = ['messenger'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: red; margin-left: 40px;"><?php echo e($errors->first('messenger')); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="mt-2 text-right">
                        <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dell\Desktop\viettel\challenge1.2-bc-main\resources\views/messenger/add_messenger.blade.php ENDPATH**/ ?>