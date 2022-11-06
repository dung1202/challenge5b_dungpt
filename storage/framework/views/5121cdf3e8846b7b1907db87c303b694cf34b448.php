<?php if(auth()->check()): ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <?php if(auth()->user()->isRole('student')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>">Trang chủ sinh viên</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>">Trang chủ giảng viên</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link btn btn-success" href="<?php echo e(route('messenger.notify')); ?>" style="color: white">
                    Tin nhắn của bạn
                </a>
            </li>
        </ul>
        <span class="navbar-text">
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
        </span>
    </div>
</nav>
<?php endif; ?><?php /**PATH C:\Users\Dell\Desktop\viettel\challenge1.2-bc-main\resources\views/navbar.blade.php ENDPATH**/ ?>