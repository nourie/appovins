<?php $__env->startSection('title'); ?>
<title>قائمة الاجهاضات </title>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
<h1> قائمة الاجهاضات </h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">رقم الام</th>
          <th scope="col">تاريخ الاجهاض</th>
          <th scope="col">العدد </th>
          <th scope="col">التبليغ من</th>
        </tr>
        </thead>
        <tbody>

         <?php $__currentLoopData = $avorters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avorter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <th scope="row">
              <?php echo e($avorter->id); ?></th>
          <td><?php echo e($avorter->num); ?></td>
          <td><?php echo e($avorter->date_avorter); ?></td>
          <td><?php echo e($avorter->nombre); ?></td>
          <td><?php echo e($avorter->name); ?></td>

      </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
    إضهار من  <?php echo e($avorters->firstItem()); ?> إلى <?php echo e($avorters->LastItem()); ?> على <?php echo e($avorters->total()); ?>

    <?php echo e($avorters->links()); ?>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/avorter/index.blade.php ENDPATH**/ ?>