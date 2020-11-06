<div class="sidebar" data-color="blue" data-image="<?php echo e(asset('light-bootstrap/img/sidebar-4.jpg')); ?>">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="/" class="simple-text">
                <img style="border-radius: 8px; width: 100% !important"  src="/light-bootstrap/img/logo.png">
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item <?php if($activePage == 'dashboard'): ?> active <?php endif; ?>">
                <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p><?php echo e(__("Dashboard")); ?></p>
                </a>
            </li>
           
            <li class="nav-item">
               
                <div class="collapse <?php if($activeButton =='laravel'): ?> show <?php endif; ?>" id="laravelExamples">
                    <ul class="nav">
                        <li class="nav-item <?php if($activePage == 'user'): ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php echo e(route('profile.edit')); ?>">
                                <i class="nc-icon nc-single-02"></i>
                                <p><?php echo e(__("My Profile")); ?></p>
                            </a>
                        </li>
                        <li class="nav-item <?php if($activePage == 'user-management'): ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php echo e(route('user.index')); ?>">
                                <i class="nc-icon nc-circle-09"></i>
                                <p><?php echo e(__("Manage Agents")); ?></p>
                            </a>
                        </li>
                        
                        <li class="nav-item <?php if($activePage == 'leads-management'): ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php echo e(route('emails.manage')); ?>">
                                <i class="nc-icon nc-email-85"></i>
                                <p><?php echo e(__("Manage Leads")); ?></p>
                            </a>
                        </li>
                        <li class="nav-item <?php if($activePage == 'priority-management'): ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php echo e(route('priorities.index')); ?>">
                                <i class="nc-icon nc-preferences-circle-rotate"></i>
                                <p><?php echo e(__("Rules & Priorities")); ?></p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
<?php /**PATH /var/www/llamaeats/llama-eats-2/resources/views/layouts/navbars/sidebar.blade.php ENDPATH**/ ?>