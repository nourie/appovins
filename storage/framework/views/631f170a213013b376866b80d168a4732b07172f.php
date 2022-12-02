<?php $__env->startSection('title'); ?>
قائمة البيع
<?php $__env->stopSection(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<?php $__env->startSection('contenu'); ?>
<h1> قائمة البيع </h1>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">العدد</th>
          <th scope="col">تاريخ البيع</th>
          <th scope="col">الذكور</th>
          <th scope="col">الاناث</th>
          <th scope="col">الخراف</th>
          <th scope="col">المشتري</th>
          <th scope="col">الثمن</th>

        </tr>
        </thead>
        <tbody>
         <?php $__currentLoopData = $ventes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Vente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <th scope="row">
              <?php echo e($Vente->id); ?></th>
          <td><?php echo e($Vente->nombre_vente); ?></td>
          <td><?php echo e($Vente->date_vente); ?></td>
          <td><?php echo e($Vente->nb_male); ?></td>
          <td><?php echo e($Vente->nb_female); ?></td>
          <td><?php echo e($Vente->nb_angeau); ?></td>
          <td><?php echo e($Vente->name); ?></td>
          <td><?php echo e($Vente->prix_vente); ?></td>
          <?php if( $Vente->updatable==1): ?>
          <td><a class="btn btn-primary" href="<?php echo e(route('achat.edit',$vente->id)); ?>" role="button" >تعديل</a></td>
          <?php else: ?>
          <td>مأكدة</td>
          <?php endif; ?>
         </td>



        </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
    إضهار من  <?php echo e($ventes->firstItem()); ?> إلى <?php echo e($ventes->LastItem()); ?> على <?php echo e($ventes->total()); ?>

    <?php echo e($ventes->links()); ?>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/ventes/index.blade.php ENDPATH**/ ?>