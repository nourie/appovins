<?php $__env->startSection('title'); ?>
<title>إضافة حيوان</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenu'); ?>
<h1>إضافة حيوان</h1>

<form action="<?php echo e(route('ovins.store')); ?>" method="post">
    <?php echo csrf_field(); ?>
     <div class="c100">
        <label for="numéro">Numéro : </label>
        <input type="number" id="num" name="num" maxlength = 20 minlength=1 class="<?php $__errorArgs = ['num'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required value=<?php echo e(old('num')); ?>>
        <?php $__errorArgs = ['num'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
           <div class="alert alert-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
       <div class="c100">
        <label for="date_achat">Date achat : </label>
        <input type="date" id="date_achat" name="date_achat" required class="<?php $__errorArgs = ['date_achat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value=<?php echo e(old('date_achat')); ?>>
    </div>
    <div class="c100">
        <label for="poid"> Le poids: </label>
        <input type="number" id="poid" name="poid" minlength=1 maxlength=3 value=<?php echo e(old('poid')); ?> >
    </div>

    <div class="c100">
        <input type="radio" id="Male" name="sexe" value="Male" >
        <label for="Male">Male</label>
        <input type="radio" id="Female" name="sexe" value="Female" checked>
        <label for="Female">Female</label>
    </div>

    <div class="c100" id="submit">
        <input type="submit" value="Ajouter">
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('sidebar'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('sidebar'); ?>
<h1> poste side barre  </h1>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/ovins/create.blade.php ENDPATH**/ ?>