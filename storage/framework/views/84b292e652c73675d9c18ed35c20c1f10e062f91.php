<?php $__env->startSection('title'); ?>
<title>قائمة الولادات </title>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
<h1> قائمة الولادات </h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">رقم الام</th>
          <th scope="col">تاريخ الولادة</th>
          <th scope="col">العدد </th>
          <th scope="col">الأحياء</th>
          <th scope="col">الذكور</th>
          <th scope="col">الاناث</th>
          <th scope="col">التبليغ من</th>
        </tr>
        </thead>
        <tbody>

         <?php $__currentLoopData = $naissances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $naissance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <th scope="row">
              <?php echo e($naissance->id); ?></th>
          <td><?php echo e($naissance->num); ?></td>
          <td><?php echo e($naissance->date_naissance); ?></td>
          <td><?php echo e($naissance->nombre); ?></td>
          <td><?php echo e($naissance->nombre_en_vie); ?></td>
          <td><?php echo e($naissance->nombre_male); ?></td>
          <td><?php echo e($naissance->nombre_female); ?></td>
          <td><?php echo e($naissance->name); ?></td>

          
        </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
    إضهار من  <?php echo e($naissances->firstItem()); ?> إلى <?php echo e($naissances->LastItem()); ?> على <?php echo e($naissances->total()); ?>

    <?php echo e($naissances->links()); ?>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/naissance/index.blade.php ENDPATH**/ ?>