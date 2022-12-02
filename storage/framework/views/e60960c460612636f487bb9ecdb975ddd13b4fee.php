<?php $__env->startSection('title'); ?>
<title>نفوق حيوان</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenu'); ?>
<h1>نفوق حيوان</h1>

<form  action="<?php echo e(route('ovins.adddie',$ovins->id)); ?>" method="post" >
    <?php echo csrf_field(); ?>
    <?php echo e(method_field('PUT')); ?>

    <!-- @   method('PUT');-->
     <div class="col-mb-3">
        <label for="numéro" class="form-label">الرقم : </label>
        <input type="number" id="num" name="num" maxlength = 20 minlength=1 class="form-control" class="<?php $__errorArgs = ['num'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required value="<?php echo e($ovins->num); ?>" readonly="readonly">
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
    <?php if(is_null($ovins->date_achat)): ?>
</div>
<div class="mb-3">
 <label for="date_achat">تاريخ الولادة : </label>
 <input type="date" id="date_achat" name="date_achat" required class="<?php $__errorArgs = ['date_achat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($ovins->date_naissance); ?>" readonly="readonly">
</div>
    <?php else: ?>
</div>
<div class="mb-3">
 <label for="date_achat">تاريخ الشراء : </label>
 <input type="date" id="date_achat" name="date_achat" required class="<?php $__errorArgs = ['date_achat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($ovins->date_achat); ?>" readonly="readonly">
</div>
    <?php endif; ?>



    <div class="mb-3">
        <label for="poid"> الوزن : </label>
        <input type="number" class="form-control" id="poid" name="poid" minlength=1 maxlength=3 value="<?php echo e($ovins->poid); ?>" readonly="readonly">
    </div>


    <div class="mb-3">
    <?php if($ovins->sexe==0): ?>
      <label for="female">الجنس:أنثى </label>


    <?php else: ?>
    <label for="male">الجنس: ذكر</label>


    <?php endif; ?>

    </div>
</div>
<div class="mb-3">
 <label for="die_date">تاريخ الموت : </label>

 <input type="date" id="die_date" name="die_date" required class="<?php $__errorArgs = ['die_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
 <?php if(is_null($ovins->date_naissance) ): ?>
 min="<?php echo e((date('Y-m-d',strtotime($ovins->date_achat)))); ?>"
 <?php else: ?>
 min="<?php echo e((date('Y-m-d',strtotime($ovins->date_naissance)))); ?>"
 <?php endif; ?>
 value="<?php echo e(date('Y-m-d')); ?>" max="<?php echo e(date('Y-m-d')); ?>" >
</div>
<input type="radio" id="ego" name="die_status" value="1" >
              <label for="ego">ذبح</label>
              <input type="radio" id="mort" name="die_status" value="0" checked>
              <label for="mort">موت</label>
<div class="mb-3">
    <label for="die_cause">السبب : </label>
    <input type="text" id="die_cause" name="die_cause" maxlength = 200 minlength=1 class="<?php $__errorArgs = ['die_cause'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required placeholder="سبب الموت">
    <?php $__errorArgs = ['cause'];
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

    <div class="mb-3" id="submit">
        <input type="submit" value="تأكيد">
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('sidebar'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('sidebar'); ?>
<h1> poste side barre  </h1>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/ovins/mort.blade.php ENDPATH**/ ?>