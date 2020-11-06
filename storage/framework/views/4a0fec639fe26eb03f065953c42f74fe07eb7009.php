<?php if(auth()->check() && request()->route()->getName() != null): ?>
    <?php echo $__env->make('layouts.navbars.navs.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
    <?php echo $__env->make('layouts.navbars.navs.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /var/www/llamaeats/llama-eats-2/resources/views/layouts/navbars/navbar.blade.php ENDPATH**/ ?>