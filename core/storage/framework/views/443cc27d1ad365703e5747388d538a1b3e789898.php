<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center my-4">
            <div class="col-md-12">


                <div class="card shadow">
                    <div class="card-header card-header-bg d-flex flex-wrap bg-crowd justify-content-between align-items-center">
                        <h5 class="card-title mt-2 color-white-crowd">
                            <?php if($my_ticket->status == 0): ?>
                                <span class="badge badge-light py-2 px-3"><?php echo app('translator')->get('Open'); ?></span>
                            <?php elseif($my_ticket->status == 1): ?>
                                <span class="badge badge-primary py-2 px-3"><?php echo app('translator')->get('Answered'); ?></span>
                            <?php elseif($my_ticket->status == 2): ?>
                                <span class="badge badge-warning py-2 px-3"><?php echo app('translator')->get('Replied'); ?></span>
                            <?php elseif($my_ticket->status == 3): ?>
                                <span class="badge badge-dark py-2 px-3"><?php echo app('translator')->get('Closed'); ?></span>
                            <?php endif; ?>
                            [Ticket#<?php echo e($my_ticket->ticket); ?>] <?php echo e($my_ticket->subject); ?>

                        </h5>

                        <button class="btn btn-danger close-button" type="button" title="<?php echo app('translator')->get('Close Ticket'); ?>"
                                data-toggle="modal"
                                data-target="#DelModal"><i class="fa fa-lg fa-times-circle"></i>

                        </button>

                    </div>

                    <div class="card-body">

                        <div class="accordion" id="accordionExample">

                            <div class="card">
                                <div class="card-header bf" id="headingThree">
                                    <h2 class="my-2 color">
                                        <a class="btn btn-link collapsed float-left "
                                           href="javascript:void(0)" data-toggle="collapse"
                                           data-target="#collapseThree" aria-expanded="true"
                                           aria-controls="collapseThree">
                                            <i class="fa fa-pencil-alt"></i> <?php echo app('translator')->get('Reply'); ?>
                                        </a>


                                        <a class="btn btn-link collapsed float-right accor"
                                           href="javascript:void(0)" data-toggle="collapse"
                                           data-target="#collapseThree" aria-expanded="true"
                                           aria-controls="collapseThree">
                                            <i class="fa fa-plus"></i>
                                        </a>

                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse show"
                                     aria-labelledby="headingThree"
                                     data-parent="#accordionExample">

                                    <div class="card-body">
                                        <?php if($my_ticket->status != 4): ?>
                                            <form method="post"
                                                  action="<?php echo e(route('ticket.reply', $my_ticket->id)); ?>"
                                                  enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="row justify-content-between">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                                            <textarea name="message"
                                                                                      class="form-control form-control-lg"
                                                                                      id="inputMessage"
                                                                                      placeholder="<?php echo app('translator')->get('Your Reply'); ?> ..."
                                                                                      rows="4" cols="10"></textarea>
                                                        </div>


                                                    </div>

                                                </div>

                                                <div class="row justify-content-between">

                                                    <div class="col-md-8 ">
                                                        <div class="row justify-content-between">
                                                            <div class="col-md-11">

                                                                <div class="form-group">
                                                                    <label for="inputAttachments"><?php echo app('translator')->get('Attachments'); ?></label>
                                                                    <input type="file"
                                                                           name="attachments[]"
                                                                           id="inputAttachments"
                                                                           class="form-control"/>
                                                                    <div id="fileUploadsContainer"></div>
                                                                    <p class="my-2 ticket-attachments-message text-muted">
                                                                        <?php echo app('translator')->get("Allowed File Extensions: .jpg, .jpeg, .png, .pdf"); ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-danger btn-round "
                                                                       onclick="extraTicketAttachment()">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="col-md-3">
                                                        <button type="submit"
                                                                class="btn btn-success custom-success mt-4"
                                                                name="replayTicket" value="1">
                                                            <i class="fa fa-reply"></i> <?php echo app('translator')->get('Reply'); ?>
                                                        </button>
                                                    </div>

                                                </div>
                                            </form>
                                        <?php endif; ?>

                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-body">

                                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($message->admin_id == 0): ?>



                                                <div class="row border border-primary border-radius-3 my-3 py-3 mx-2">
                                                    <div class="col-md-3 border-right text-right">
                                                        <h5 class="my-3"><?php echo e($message->ticket->name); ?></h5>
                                                    </div>

                                                    <div class="col-md-9">
                                                        <p class="text-muted font-weight-bold my-3">
                                                            <?php echo app('translator')->get('Posted on'); ?> <?php echo e($message->created_at->format('l, dS F Y @ H:i')); ?></p>
                                                        <p><?php echo e($message->message); ?></p>
                                                        <?php if($message->attachments()->count() > 0): ?>
                                                            <div class="mt-2">
                                                                <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <a href="<?php echo e(route('ticket.download',encrypt($image->id))); ?>" class="mr-3"><i class="fa fa-file"></i>  <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endif; ?>

                                                    </div>

                                                </div>

                                            <?php else: ?>


                                                <div class="row border border-warning border-radius-3 my-3 py-3 mx-2 style">

                                                    <div class="col-md-3 border-right text-right">
                                                        <h5 class="my-3"><?php echo e($message->admin->name); ?></h5>
                                                        <p class="lead text-muted">Staff</p>

                                                    </div>

                                                    <div class="col-md-9">
                                                        <p class="text-muted font-weight-bold my-3">
                                                            <?php echo app('translator')->get('Posted on'); ?> <?php echo e($message->created_at->format('l, dS F Y @ H:i')); ?></p>
                                                        <p><?php echo e($message->message); ?></p>

                                                        <?php if($message->attachments()->count() > 0): ?>
                                                            <div class="mt-2">
                                                                <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <a href="<?php echo e(route('ticket.download',encrypt($image->id))); ?>" class="mr-3"><i class="fa fa-file"></i>  <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                    </div>
                                </div>
                            </div>



                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="post" action="<?php echo e(route('ticket.reply', $my_ticket->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="modal-header">
                        <h5 class="modal-title"> <?php echo app('translator')->get('Confirmation'); ?>!</h5>

                        <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <strong class="text-dark"><?php echo app('translator')->get('Are you sure you want to Close This Support Ticket'); ?>?</strong>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>
                            <?php echo app('translator')->get('Close'); ?>
                        </button>

                        <button type="submit" class="btn btn-success btn-sm" name="replayTicket"
                                value="2"><i class="fa fa-check"></i> <?php echo app('translator')->get("Confirm"); ?>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $(document).ready(function () {
            $('.delete-message').on('click', function (e) {
                $('.message_id').val($(this).data('id'));
            });
        });

        function extraTicketAttachment() {
            $("#fileUploadsContainer").append('<input type="file" name="attachments[]" class="form-control mt-1" required />')
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>

<style>
    .style{
        background-color: #ffd96729;
    }
    .color{
        color: azure;
    }
    #headingThree{
        background: #20395D;
    }
    .bg-crowd{
        background: #16C26B;
    }

    .color-white-crowd{
        color: #ffffff;
    }
    a.btn.btn-link.collapsed.float-left {
    color: white;
}

a.btn.btn-link.collapsed.float-right.accor {
    color: white;
}

a.btn.btn-link.collapsed.float-right.accor:focus{
    color: white;
}

a.btn.btn-danger.btn-round {
    margin: 34px 20px;
}
    
</style>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/user/support/view.blade.php ENDPATH**/ ?>