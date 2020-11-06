
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">LEADBOX MANAGEMENT SYSTEM </a>
 
<span class="no-icon mr-2 nav-link"> Logged in as: <?php echo e(\Auth::user()->name); ?> </span>
    <button class=" btn btn-danger" >
       
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <a class="text-danger" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <?php echo e(__('Log out')); ?> </a>
            </form>
     
    </button>
</nav>


<?php /**PATH /var/www/llamaeats/llama-eats-2/resources/views/layouts/navbars/navs/auth.blade.php ENDPATH**/ ?>