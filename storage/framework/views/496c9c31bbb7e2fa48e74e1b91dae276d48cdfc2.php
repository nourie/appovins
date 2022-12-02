<?php $__env->startSection('title'); ?>
    <title> ترقيم الحيوانات </title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenu'); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <h1>ترقيم الحيوانات </h1>
    
    <form action="<?php echo e(route('achat.numerotation')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <?php echo e(method_field('GET')); ?>

        <!-- @   method('PUT');-->
        <input id="id" name="id" type="hidden" value="<?php echo e($achats->id); ?>">
        <div class="form-floating">
            <textarea class="form-control" name="text" placeholder="Leave a comment here" id="floatingTextarea2"
                style="height: 100px"></textarea>
            <label for="floatingTextarea2">إدخال الأرقام على الشكل 1 إلى 100 على الشكل 1-100</label>
        </div>
        <div class="c100">
            <label for="date_achat">تاريخ الشراء : </label>
            <input type="date" id="date_achat" name="date_achat" required max="<?php echo e(date('Y-m-d')); ?>" min="2022-01-01"
                class="<?php $__errorArgs = ['date_achat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value=<?php echo e($achats->date_achat); ?>>
        </div>
        <div class="c100">
            <label for="nb_male"> عدد الذكور: </label>
            <input type="number" id="nb_male" name="nb_male" min=0 minlength=1 maxlength=3 value=<?php echo e($achats->nb_male); ?>

                readonly="readonly">
        </div>
        <div class="c100">
            <label for="nb_female"> عدد الاناث: </label>
            <input type="number" id="nb_female" name="nb_female" min=0 minlength=1 maxlength=3
                value=<?php echo e($achats->nb_female); ?> readonly="readonly">
        </div>
        <div class="c100">
            <label for="nb_angeau"> عدد الخراف: </label>
            <input type="number" id="nb_angeau" name="nb_angeau" min=0 minlength=1 maxlength=3
                value=<?php echo e($achats->nb_agneau); ?> readonly="readonly">
        </div>
        <div id="submit">
            <input type="submit" value="إضافة">
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/achat/numerotation.blade.php ENDPATH**/ ?>