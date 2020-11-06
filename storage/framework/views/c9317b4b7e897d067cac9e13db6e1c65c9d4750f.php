
<div class="navbar navbar-transparent  navbar-absolute mb-4" style="background-color: transparent!important; padding-top: 0!important;">
    <a class="navbar-brand" href="/">
        <img style=" width:100% !important;max-width: 230px !important;"  src="/light-bootstrap/img/logo.png">
    </a>
    <ul class="navbar-nav">
        <li class="nav-item <?php if($activePage == 'login'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('login')); ?>" class="nav-link">
                <i class="nc-icon nc-mobile"></i> <?php echo e(__('Login')); ?>

            </a>
        </li>   
    </ul>
</div> <?php /**PATH /var/www/llamaeats/llama-eats-2/resources/views/layouts/navbars/navs/guest.blade.php ENDPATH**/ ?>