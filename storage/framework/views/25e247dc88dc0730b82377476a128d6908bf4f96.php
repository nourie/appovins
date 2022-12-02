<?php $__env->startSection('title'); ?>
قائمة الشراء
<?php $__env->stopSection(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<?php $__env->startSection('contenu'); ?>
<h1> قائمة <?php echo e($titre); ?> </h1>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">العدد</th>
          <th scope="col">تاريخ <?php echo e($date); ?></th>
          <th scope="col">الذكور</th>
          <th scope="col">الاناث</th>
          <th scope="col">الخراف</th>
          <th scope="col">البائع</th>
          <th scope="col">الثمن</th>

        </tr>
        </thead>
        <tbody>
         <?php $__currentLoopData = $achats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <th scope="row">
              <?php echo e($achat->id); ?></th>
          <td><?php echo e($achat->nombre_achat); ?></td>
          <td><?php echo e($achat->date_achat); ?></td>
          <td><?php echo e($achat->nb_male); ?></td>
          <td><?php echo e($achat->nb_female); ?></td>
          <td><?php echo e($achat->nb_angeau); ?></td>
          <td><?php echo e($achat->id_vendeur); ?></td>
          <td><?php echo e($achat->prix_achat); ?></td>
          <?php if( $achat->updatable==1): ?>
          <td><a class="btn btn-primary" href="<?php echo e(route('achat.edit',$achat->id)); ?>" role="button" >تعديل</a></td>
          <?php else: ?>
          <td>مأكدة</td>
          <?php endif; ?>
          <?php if( $achat->numerotable==1): ?>
          <td>
            <a class="btn btn-success"  href="<?php echo e(route('achat.anumeroter',$achat->id)); ?>" role="button">ترقيم</a>
        </td>
          <?php else: ?>
          <td>مرقمة</td>
          <?php endif; ?>
        </td>



        </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
    إضهار من  <?php echo e($achats->firstItem()); ?> إلى <?php echo e($achats->LastItem()); ?> على <?php echo e($achats->total()); ?>

    <?php echo e($achats->links()); ?>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/achat/index.blade.php ENDPATH**/ ?>