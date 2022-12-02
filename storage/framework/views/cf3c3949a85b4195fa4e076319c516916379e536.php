<?php $__env->startSection('title'); ?>
    <title>قائمة الميتة </title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenu'); ?>

    <div class="container">
        <form action="<?php echo e(route('ovins.update', $ovin->id)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo e(method_field('PUT')); ?>

            <!-- @   method('PUT');-->
            <div class="row">
                <div class="row">
                    <label for="num">الرقم : </label>
                    <input type="text" class="form-control" name="num" value="<?php echo e($ovin->num); ?>">
                </div>
                <div class="col">
                    <label for="date_achat">تاريخ الشراء : </label>
                    <input type="date" class="form-control" name="date_achat" value="<?php echo e($ovin->date_achat); ?>"
                        readonly='readonly'>
                </div>
                <div class="col">
                    <label for="date_naissance">تاريخ الولادة : </label>
                    <input type="date" class="form-control" name="date_naissance" value="<?php echo e($ovin->date_naissance); ?>"
                        readonly='readonly'>
                </div>
                <div class="row">
                    <label for="cause">سبب التعديل : </label>
                    <input type="text" class="form-control" name="cause" placeholder="السبب">
                </div>
                <div class="row">
                    <label for="poid">الوزن : </label>
                    <input type="number" class="form-control" name="poid"
                        value="<?php echo e($ovin->poid); ?>"placeholder="الوزن">
                </div>
                <div class="col">
                    <?php if($ovin->sexe == 1): ?>
                        <input type="radio" id="Male" name="sexe" value="Male" checked>
                        <label for="Male">ذكر</label>
                        <input type="radio" id="Female" name="sexe" value="Female">
                        <label for="Female">أنثئ</label>
                    <?php else: ?>
                        <input type="radio" id="Male" name="sexe" value="Male">
                        <label for="Male">ذكر</label>
                        <input type="radio" id="Female" name="sexe" value="Female" checked>
                        <label for="Female">أنثئ</label>
                    <?php endif; ?>

                </div>
                <div class="row">
                    <button class="btn btn-primary" type="submit">تحديث</button>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/ovins/edit.blade.php ENDPATH**/ ?>