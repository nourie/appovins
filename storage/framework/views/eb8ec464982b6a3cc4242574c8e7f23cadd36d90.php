<?php $__env->startSection('title'); ?>
    قائمة الحيوانات
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <h1> قائمة الحيوانات</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">الرقم</th>
                <th scope="col">تاريخ ش/و</th>
                <th scope="col">السن</th>
                <th scope="col">الجنس</th>

            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $ovins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ovin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row">
                        <?php echo e($ovin->id); ?></th>
                    <td><?php echo e($ovin->num); ?></td>
                    <?php if(is_null($ovin->date_naissance)): ?>
                        <td><?php echo e($ovin->date_achat); ?> ش</td>
                        <td> شراء </td>
                    <?php elseif($ovin->alive == 0): ?>
                        <td><?php echo e($ovin->date_naissance); ?> و</td>

                        <td> <?php $provider = app('App\Http\Controllers\OvinController'); ?>
                            <?php echo e($provider::age($ovin->date_naissance, $ovin->die_date)[4]); ?></td>
                    <?php else: ?>
                        <td><?php echo e($ovin->date_naissance); ?> و</td>
                        <td> <?php $provider = app('App\Http\Controllers\OvinController'); ?>
                            <?php echo e($provider::age($ovin->date_naissance, date('Y-m-d'))[4]); ?></td>
                    <?php endif; ?>

                    <?php if($ovin->sexe == 1): ?>
                        <td>ذكر</td>
                    <?php else: ?>
                        <td>أنثى</td>
                    <?php endif; ?>
                    <?php if(auth()->user()->userrole == 2): ?>
                        <?php if($ovin->vendu == 1): ?>
                            <td>بيع </td>
                        <?php elseif($ovin->vendu == 2): ?>
                            <td>إعادة </td>
                        <?php elseif($ovin->alive == 0): ?>
                            <td>ميتة </td>
                        <?php elseif($ovin->alive == 1): ?>
                            <td>حية </td>
                        <?php endif; ?>
                    <?php elseif(auth()->user()->userrole == 1): ?>
                        <?php if($ovin->alive == 1 && $ovin->vendu == 0): ?>
                            <td><a class="btn btn-primary" href="<?php echo e(route('ovins.edit', $ovin->id)); ?>" role="button">تعديل</a>
                                <?php $provider = app('App\Http\Controllers\OvinController'); ?>

                                <?php if($ovin->sexe == 0 && $provider::age($ovin->date_naissance, date('Y-m-d'))[0]): ?>
                                    <a class="btn btn-success" href="<?php echo e(route('ovins.naissance', $ovin->id)); ?>"
                                        role="button">ولادة</a>
                                    <a class="btn btn-warning" href="<?php echo e(route('ovins.avorter', $ovin->id)); ?>"
                                        role="button">إجهاض</a>
                                <?php endif; ?>
                            </td>

                            <td>
                                <form method="POST" action="<?php echo e(url('/ovins' . '/' . $ovin->id)); ?>">
                                    <?php echo e(method_field('DELETE')); ?>

                                    <?php echo e(csrf_field()); ?>

                                    <button class="btn btn-danger" name="delete" type="submit">نفوق</button>
                                </form>
                            </td>
                        <?php else: ?>
                            <?php if($ovin->vendu == 1): ?>
                                <td>بيع </td>
                            <?php elseif($ovin->vendu == 2): ?>
                                <td>إعادة </td>
                            <?php else: ?>
                                <td>ميتة </td>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    إظهار من <?php echo e($ovins->firstItem()); ?> إلى <?php echo e($ovins->LastItem()); ?> على <?php echo e($ovins->total()); ?>

    <?php echo e($ovins->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/ovins/index.blade.php ENDPATH**/ ?>