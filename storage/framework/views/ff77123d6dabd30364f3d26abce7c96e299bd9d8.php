<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card data-tables">

                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0"><?php echo e(__('Users')); ?></h3>
                                    <p class="text-sm mb-0">
                                        
                                    </p>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="<?php echo e(route('user.create')); ?>" class="btn btn-sm btn-default"><?php echo e(__('Add user')); ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <?php echo $__env->make('alerts.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('alerts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Start')); ?></th>
                                    <th><?php echo e(__('Actions')); ?></th>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><?php echo e(__('Name')); ?></th>
                                        <th><?php echo e(__('Email')); ?></th>
                                        <th><?php echo e(__('Start')); ?></th>
                                        <th><?php echo e(__('Actions')); ?></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->email); ?></td>
                                            <td><?php echo e($user->created_at); ?></td>
                                            <td class="d-flex justify-content-end">
                                                <?php if($user->id != auth()->id()): ?>
                                                    <a href="<?php echo e(route('user.edit', $user->id)); ?>" class="btn btn-link btn-warning edit d-inline-block"><i class="fa fa-edit"></i></a>

                                                    <form class="d-inline-block" action="<?php echo e(route('user.destroy', $user->id)); ?>" method="POST">
                                                        <?php echo method_field('delete'); ?>
                                                        <?php echo csrf_field(); ?>
                                                        <a class="btn btn-link btn-danger " onclick="confirm('<?php echo e(__('Are you sure you want to delete this user?')); ?>') ? this.parentElement.submit() : ''"s><i class="fa fa-times"></i></a>
                                                    </form>
                                                <?php else: ?>    
                                                    <a href="<?php echo e(route('profile.edit', $user->id)); ?>" class="btn btn-link btn-warning edit d-inline-block"><i class="fa fa-edit"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }

            });


            var table = $('#datatables').DataTable();

            // Delete a record
            table.on('click', '.remove', function(e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'user-management', 'activeButton' => 'laravel', 'title' => 'Leadbox System', 'navName' => 'Users'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/llamaeats/llama-eats-2/resources/views/users/index.blade.php ENDPATH**/ ?>