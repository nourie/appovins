<?php $__env->startSection('title'); ?>
    <title>قائمة الميتة </title>
<?php $__env->stopSection(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<?php $__env->startSection('contenu'); ?>
    <h1> قائمة الميتة </h1>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">الرقم</th>
                <th scope="col">تاريخ ش/و</th>
                <th scope="col">تاريخ النفوق</th>
                <th scope="col">الجنس</th>
                <th scope="col">الحالة</th>
                <th scope="col">السبب</th>



            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $ovins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ovin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row">
                        <?php echo e($ovin->id); ?></th>
                    <td><?php echo e($ovin->num); ?></td>
                    <?php if(is_null($ovin->date_achat)): ?>
                        <td><?php echo e($ovin->date_naissance); ?> و</td>
                    <?php else: ?>
                        <td><?php echo e($ovin->date_achat); ?> ش</td>
                    <?php endif; ?>

                    <td><?php echo e($ovin->die_date); ?></td>
                    <?php if($ovin->sexe == 1): ?>
                        <td>ذكر</td>
                    <?php else: ?>
                        <td>أنثى</td>
                    <?php endif; ?>
                    <?php if($ovin->die_status == 1): ?>
                        <td>ذبح</td>
                    <?php else: ?>
                        <td>موت</td>
                    <?php endif; ?>
                    <td><?php echo e($ovin->die_cause); ?></td>


                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    إظهار من <?php echo e($ovins->firstItem()); ?> إلى <?php echo e($ovins->LastItem()); ?> على <?php echo e($ovins->total()); ?>

    <?php echo e($ovins->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/die/index.blade.php ENDPATH**/ ?>