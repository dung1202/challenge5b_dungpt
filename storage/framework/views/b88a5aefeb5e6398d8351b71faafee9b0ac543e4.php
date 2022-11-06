<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->isRole('admin')): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo e(url('/')); ?>">List User <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('role.index')); ?>">List Role</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-success" href="<?php echo e(route('messenger.notify')); ?>" style="color: white">
                        Tin nhắn của bạn: <?php echo e($messAll); ?>

                    </a>
                </li>
            <?php endif; ?>
        </ul>
        <span class="navbar-text">
            <?php if(auth()->check()): ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo e(auth()->user()->name); ?>

                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo e(route('user.show', ['user' => auth()->user()->id])); ?>">Thông tin tài khoản</a>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">Đăng xuất</a>
                        </div>
                    </li>
                </ul>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">Đăng nhập</a>
                <a href="<?php echo e(route('register.index')); ?>" class="btn btn-primary">Đăng ký</a>
            <?php endif; ?>
        </span>
    </div>
</nav><?php /**PATH C:\xampp\htdocs\bluecyber_laravel-8x\resources\views/navbar.blade.php ENDPATH**/ ?>