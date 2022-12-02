<?php $__env->startSection('title'); ?>
<title>  شراء الحيوانات  </title>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenu'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<h1>شراء الحيوانات </h1>

<form action="<?php echo e(route('achat.addachat')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <?php echo e(method_field('GET')); ?>

    <!-- @   method('PUT');-->
    <div class="c100">
        <label for="nombre_achat">العدد : </label>
        <input type="text" id="nombre_achat" name="nombre_achat" min=0 maxlength = 20
        minlength=1 class="<?php $__errorArgs = ['nombre_achat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required value=<?php echo e(old('nombre_achat')); ?>>
        <?php $__errorArgs = ['nombre_achat'];
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
        <label for="date_achat">تاريخ الشراء : </label>
        <input type="date" id="date_achat" name="date_achat" required max="<?php echo e(date('Y-m-d')); ?>"
        min="2022-01-01" class="<?php $__errorArgs = ['date_achat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value=<?php echo e(old('date_achat')); ?>    >
    </div>
    <div class="c100">
        <label for="nb_male"> عدد الذكور: </label>
        <input type="number" id="nb_male" name="nb_male" min=0 minlength=1 maxlength=3 value=<?php echo e(old('nb_male')); ?> >
    </div>
    <div class="c100">
        <label for="nb_female"> عدد الاناث: </label>
        <input type="number" id="nb_female" name="nb_female" min=0 minlength=1 maxlength=3 value=<?php echo e(old('nb_female')); ?> >
    </div>
    <div class="c100">
        <label for="nb_angeau"> عدد الخراف: </label>
        <input type="number" id="nb_angeau" name="nb_angeau"  min=0 minlength=1 maxlength=3 value=<?php echo e(old('nb_angeau')); ?> >
    </div>
     <div class="c100">
        <label for="vendeur">البائع:</label>
        <select name="vendeur" id="vendeur">

          <optgroup label="---">
            <?php
             $user = \App\Models\User::where('userrole',3)->get();
             ?>
            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($users->id); ?>"><?php echo e($users->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </optgroup>
         </select>
    </div>
    <div class="c100">
        <label for="prix_achat"> الثمن: </label>
        <input type="number" id="prix_achat" name="prix_achat"  min=0  step="0.01" value=<?php echo e(old('prix_achat')); ?> >
    </div>

    <div class="c100" id="submit">
        <input type="submit" value="إضافة">
    </div>
</form>
<?php $__env->stopSection(); ?>

<div>
<?php if(auth()->guard()->guest()): ?>
<div class="shrink-0 flex items-center">
    <a href="<?php echo e(route('dashboard')); ?>">
       يجب تسجيل الدخول
    </a>
</div>
<?php endif; ?>
</div>


<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/achat/achat.blade.php ENDPATH**/ ?>