
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <form  action="<?php echo e(route('achat.update',$achat->id)); ?>" method="post" >
        <?php echo csrf_field(); ?>
        <?php echo e(method_field('PUT')); ?>

        <!-- @   method('PUT');-->
        <div class="c100">
            <label for="numéro">العدد : </label>
            <input type="text" id="nombre_achat" name="nombre_achat" min=0 maxlength = 20 minlength=1 class="<?php $__errorArgs = ['nombre_achat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required value=<?php echo e($achat->nombre_achat); ?>>
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
            <label for="date_achat">Date achat : </label>
            <input type="date" id="date_achat" name="date_achat" required class="<?php $__errorArgs = ['date_achat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value=<?php echo e($achat->date_achat); ?>>
        </div>
        <div class="c100">
            <label for="nb_male"> عدد الذكور: </label>
            <input type="number" id="nb_male" name="nb_male" min=0 minlength=1 maxlength=3 value=<?php echo e($achat->nb_male); ?> >
        </div>
        <div class="c100">
            <label for="nb_female"> عدد الاناث: </label>
            <input type="number" id="nb_female" name="nb_female" min=0 minlength=1 maxlength=3 value=<?php echo e($achat->nb_female); ?> >
        </div>
        <div class="c100">
            <label for="nb_angeau"> عدد الخراف: </label>
            <input type="number" id="nb_angeau" name="nb_angeau"  min=0 minlength=1 maxlength=3 value=<?php echo e($achat->nb_angeau); ?> >
        </div>
        <div class="c100">
            <label for="debut_num"> الترقيم من: </label>
            <input type="number" id="debut_num" name="debut_num" min=0 minlength=1 maxlength=3 value=<?php echo e($achat->debut_num); ?> >
        </div>
        <div class="c100">
            <label for="fin_num"> الترقيم إلى: </label>
            <input type="number" id="fin_num" name="fin_num" min=0 minlength=1 maxlength=3 value=<?php echo e($achat->fin_num); ?> >
        </div>
        <div class="c100">
            <label for="vendeur">البائع:</label>
            <select name="vendeur" id="vendeur">

              <optgroup label="---">
                <?php
                 $user = \App\Models\User::where ('id',$achat->id_vendeur)->get();
                 ?>
                <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($users->id); ?>"><?php echo e($users->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </optgroup>
             </select>
        </div>
        <div class="c100">
            <label for="prix_achat"> الثمن: </label>
            <input type="number" id="prix_achat" name="prix_achat"  min=0  step="0.01" value=<?php echo e($achat->prix_achat); ?> >
        </div>

      <div class="col">
        <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </div>
  </form>
<?php /**PATH K:\laraval\AppOvins\resources\views/achat/edit.blade.php ENDPATH**/ ?>