<?php $__env->startSection('content'); ?>
    <?php
    $unassignedTotal = $assignedTotal = $rejectedTotal = $reassignedTotal = 0;
    ?>
    <div class="content">
        <div class="container-fluid">
            <div class="col-12 mt-2">
                <?php echo $__env->make('alerts.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('alerts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card striped-tabled-with-hover">
                        <div class="card-header  text-center">
                            <h3 class="card-title ">Leads</h3>
                            <p class="card-category ">Here you can view or delete the leads.</p>
                        </div>
                        <div class="card-body">
                        <?php
                        foreach ($leadMails as $leadMail){
                                    
                                    if($leadMail->agent_id == 0){
                                        $unassignedTotal++;
                                    } elseif($leadMail->rejected > 0){
                                        $rejectedTotal++;
                                    } elseif($leadMail->old_agent_id > 0){
                                        $reassignedTotal++;
                                    } else {
                                        $assignedTotal++;
                                    }
                        }
                        ?>
                        <div class="p-4 text-center">
                            <label for="time-set">Run the report by dates: </label>
                            <form method='POST'>
                                <?php echo csrf_field(); ?>
                                <input type="date" id="from-date" name="from-date" value="<?php echo e(explode(' ', $dateFrom)[0]); ?>" > to <input type="date" id="to-date" name="to-date" value="<?php echo e(explode(' ', $dateTo)[0]); ?>" >
                            <form>
                            <button type="submit" class="btn btn-primary">Submit</a>
                        </div>
                        <ul class="nav nav-tabs">
                        <li class="nav-item">
                        <button class="nav-link active" onclick="openReport(event, 'unassigned', this)">Unassigned (<?php echo e($unassignedTotal); ?>)</button>
                        </li> 
                        <li class="nav-item">
                        <button class="nav-link" onclick="openReport(event, 'assigned', this)">Assigned (<?php echo e($assignedTotal); ?>)</button>
                        </li>
                        <li class="nav-item">
                        <button class="nav-link" onclick="openReport(event, 'rejected', this)">Rejected (<?php echo e($rejectedTotal); ?>)</button>
                        </li>
                        <li class="nav-item">
                        <button class="nav-link" onclick="openReport(event, 'reassigned', this)">Reassigned (<?php echo e($reassignedTotal); ?>)</button>
                        </li>
                        </ul>
                        <div id="unassigned" class="type" >
                            <table class="table table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Sender </th>
                                    <th class="col-md-6">Subject Line </th>
                                    <th>Time/date</th>
                                    <th>Options</th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $leadMails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leadMail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($leadMail->agent_id == 0): ?>
                                    <tr>
                                        <td><span id="mail-from"><?php echo e($leadMail->id); ?></span></td>
                                        <td><span id="mail-from"><?php echo e($leadMail->email_from); ?></span></td>
                                        <td class="col-md-6"><span id="mail-subject"><?php echo e($leadMail->subject); ?></span></td>
                                        
                                        <td class="col-md-2"><span id="mail-date"><?php echo e(\Carbon\Carbon::parse($leadMail->received_date)->format('m/d/Y g:i A')); ?></span> </td>
                                        <td class="d-flex justify-content-end">
                                                    <?php if($leadMail->attachment): ?>
                                                        <a href="<?php echo e(route('leads.download', $leadMail->id)); ?>" target="_blank" class="btn btn-link btn-warning edit d-inline-block" title="Attachment available."><i class="fa fa-paperclip"></i></a>
                                                    <?php else: ?>
                                                        <a href="#" target="_blank" class="btn disabled btn-link btn-warning edit d-inline-block"><i class="fa fa-paperclip"></i></a>
                                                    <?php endif; ?>
                                                    <a data-toggle="modal" data-id="<?php echo e($leadMail->id); ?>" data-type="body" data-target="#leadsModal" class="btn btn-link btn-warning getbody d-inline-block"><i class="fa fa-file" title="Read full email."></i></a>

                                                    <a class="btn btn-link btn-danger " onclick="confirm('<?php echo e(__('Are you sure you want to delete this Lead?')); ?>') ? window.location.href='<?php echo e(route('leads.destroy', $leadMail->id)); ?>' : ''"s><i class="fa fa-times" title="Delete."></i></a>
                                            </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            </div>
                            <div id="assigned" style="display:none" class="type" >
                                <table class="table table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>Sender </th>
                                        <th style="width:200px">Subject Line </th>
                                        <th style="width:200px">Agent</th>
                                        <th>Time/date</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $leadMails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leadMail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($leadMail->agent_id > 0): ?>
                                        <tr>
                                            <td><span id="mail-from"><?php echo e($leadMail->id); ?></span></td>
                                            <td><span id="mail-from"><?php echo e($leadMail->email_from); ?></span></td>
                                            <td><?php echo e($leadMail->subject); ?></td>
                                            <td ><?php echo e(optional(optional($leadMail->agent())->first())->name); ?></td>
                                            
                                            <td><span id="mail-date"><?php echo e(\Carbon\Carbon::parse($leadMail->received_date)->format('m/d/Y g:i A')); ?></span> </td>
                                            <td class="d-flex justify-content-end">
                                                        <?php if($leadMail->attachment): ?>
                                                            <a href="<?php echo e(route('leads.download', $leadMail->id)); ?>" target="_blank" class="btn btn-link btn-warning edit d-inline-block" title="Attachment available."><i class="fa fa-paperclip"></i></a>
                                                        <?php else: ?>
                                                            <a href="#" target="_blank" class="btn disabled btn-link btn-warning edit d-inline-block"><i class="fa fa-paperclip"></i></a>
                                                        <?php endif; ?>
                                                        <a data-toggle="modal" data-id="<?php echo e($leadMail->id); ?>" data-type="body" data-target="#leadsModal" class="btn btn-link btn-warning getbody d-inline-block"><i class="fa fa-file" title="Read full email."></i></a>

                                                        <a class="btn btn-link btn-danger " onclick="confirm('<?php echo e(__('Are you sure you want to delete this Lead?')); ?>') ? window.location.href='<?php echo e(route('leads.destroy', $leadMail->id)); ?>' : ''"s><i class="fa fa-times" title="Delete."></i></a>
                                                </td>
                                        </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="rejected" style="display:none" class="type" >
                                <table class="table table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>Sender </th>
                                        <th style="width:200px">Subject Line </th>
                                        <th style="width:200px">Agent</th>
                                        <th>Time/date</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $leadMails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leadMail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($leadMail->rejected != 0): ?>
                                        <tr>
                                            <td><span id="mail-from"><?php echo e($leadMail->id); ?></span></td>
                                            <td><span id="mail-from"><?php echo e($leadMail->email_from); ?></span></td>
                                            <td><?php echo e($leadMail->subject); ?></td>
                                            <td ><?php echo e(optional(optional($leadMail->agent())->first())->name); ?></td>
                                            
                                            <td><span id="mail-date"><?php echo e(\Carbon\Carbon::parse($leadMail->received_date)->format('m/d/Y g:i A')); ?></span> </td>
                                            <td class="d-flex justify-content-end">
                                                        <?php if($leadMail->attachment): ?>
                                                            <a href="<?php echo e(route('leads.download', $leadMail->id)); ?>" target="_blank" class="btn btn-link btn-warning edit d-inline-block" title="Attachment available."><i class="fa fa-paperclip"></i></a>
                                                        <?php else: ?>
                                                            <a href="#" target="_blank" class="btn disabled btn-link btn-warning edit d-inline-block"><i class="fa fa-paperclip"></i></a>
                                                        <?php endif; ?>
                                                        <a data-toggle="modal" data-id="<?php echo e($leadMail->id); ?>" data-type="rejected" data-target="#leadsModal" class="btn btn-link btn-warning getbody d-inline-block"><i class="fa fa-paper-plane" title="Rejected message"></i></a>
                                                        <a data-toggle="modal" data-id="<?php echo e($leadMail->id); ?>" data-type="body" data-target="#leadsModal" class="btn btn-link btn-warning getbody d-inline-block"><i class="fa fa-file" title="Read full email."></i></a>

                                                        <a class="btn btn-link btn-danger " onclick="confirm('<?php echo e(__('Are you sure you want to delete this Lead?')); ?>') ? window.location.href='<?php echo e(route('leads.destroy', $leadMail->id)); ?>' : ''"s><i class="fa fa-times" title="Delete."></i></a>
                                                </td>
                                        </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="reassigned" style="display:none" class="type" >
                                <table class="table table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>Sender </th>
                                        <th style="width:200px">Subject Line </th>
                                        <th style="width:200px">Orig. Agent </th>
                                        <th style="width:200px">Curr. Agent </th>
                                        <th>Time/date</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $leadMails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leadMail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($leadMail->old_agent_id != 0 && !$leadMail->rejected): ?>
                                        <tr>
                                            <td><span id="mail-from"><?php echo e($leadMail->id); ?></span></td>
                                            <td><span id="mail-from"><?php echo e($leadMail->email_from); ?></span></td>
                                            <td><span id="mail-subject"><?php echo e($leadMail->subject); ?></span></td>
                                            <td ><?php echo e(optional(optional($leadMail->old_agent())->first())->name); ?></td>
                                            <td ><?php echo e(optional(optional($leadMail->agent())->first())->name); ?></td>
                                            
                                            <td><span id="mail-date"><?php echo e(\Carbon\Carbon::parse($leadMail->received_date)->format('m/d/Y g:i A')); ?></span> </td>
                                            <td class="d-flex justify-content-end">
                                                        <?php if($leadMail->attachment): ?>
                                                            <a href="<?php echo e(route('leads.download', $leadMail->id)); ?>" target="_blank" class="btn btn-link btn-warning edit d-inline-block" title="Attachment available."><i class="fa fa-paperclip"></i></a>
                                                        <?php else: ?>
                                                            <a href="#" target="_blank" class="btn disabled btn-link btn-warning edit d-inline-block"><i class="fa fa-paperclip"></i></a>
                                                        <?php endif; ?>
                                                        <a data-toggle="modal" data-id="<?php echo e($leadMail->id); ?>" data-type="reassigned" data-target="#leadsModal" class="btn btn-link btn-warning getbody d-inline-block"><i class="fa fa-paper-plane" title="Reassigned message"></i></a>
                                                        <a data-toggle="modal" data-id="<?php echo e($leadMail->id); ?>" data-type="body" data-target="#leadsModal" class="btn btn-link btn-warning getbody d-inline-block"><i class="fa fa-file" title="Read full email."></i></a>

                                                        <a class="btn btn-link btn-danger " onclick="confirm('<?php echo e(__('Are you sure you want to delete this Lead?')); ?>') ? window.location.href='<?php echo e(route('leads.destroy', $leadMail->id)); ?>' : ''"s><i class="fa fa-times" title="Delete."></i></a>
                                                </td>
                                        </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


    <div class="modal fade " id="leadsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="leadsModalBody" style="border:solid darkgray 1px!important; padding:25px; min-height:400px">
        ...
        </div>
    </div>
    </div>

<script>
function openReport(e, report, caller) {
  var i;
  var x = document.getElementsByClassName("type");

  e.preventDefault();

  $('.nav-link').removeClass('active');
  $(this).addClass('active');

  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  document.getElementById(report).style.display = "block";
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['activePage' => 'leads-management', 'title' => 'Leadbox Management System', 'navName' => 'Leads Management', 'activeButton' => 'laravel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/llamaeats/llama-eats-2/resources/views/pages/emailsmanage.blade.php ENDPATH**/ ?>