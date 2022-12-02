<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>

<?php $__env->startSection('title'); ?>
إضافة إجهاض
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenu'); ?>
    <script>
       function somme(){
           var nbr1, nbr2, sum;
           nbr1 = Number(document.getElementById("nombre_en_vie").value);
           nbr2 = Number(document.getElementById("nombre_male").value);
           sum = nbr1 - nbr2;
           document.getElementById("nombre_female").value = sum;

        }
    function valider() {
		var a,b,c,d;
		a=Number(document.getElementById("nombre").value);
		b=Number(document.getElementById("nombre_en_vie").value);
    c=Number(document.getElementById("nombre_male").value);
    d=Number(document.getElementById("nombre_female").value);

		if (a<b){
			alert(' عدد المولبد الأحياء يكون أصغر أو يساوي عدد المواليد');
      document.getElementById("nombre_en_vie").value=a;
			}
     else {
      if ((c+d)!=b){
           if ( a<b)
           {

            document.getElementById("nombre_female").value=a-c;
           }
           else {
            document.getElementById("nombre_female").value=b-c;
           }

        if (b-c<0){
          alert(' مجموع الذكور و الاناث خاطئ');
          document.getElementById("nombre_male").value=b;
          document.getElementById("nombre_female").value=0;

        }


      }
    }
		}
    </script>
 </head>


    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <body>
    <form  action="<?php echo e(route('ovins.addavorter',$ovin->id)); ?>" method="post" >
        <?php echo csrf_field(); ?>
        <?php echo e(method_field('GET')); ?>

        <!-- @   method('GET');-->
        <div class="row">
            <div class="col">

              <label for="num">الرقم : </label>
              <input type="text" class="form-control" name="num"  value="<?php echo e($ovin->num); ?>" readonly="readonly">
            </div>

            <div class="col">

              <label for="date_avorter"> تاريخ الاجهاض </label>
              <input type="date" class="form-control" name="date_avorter" value="<?php echo e(date('Y-m-d')); ?>">

            </div>

            <div class="col">

              <label for="nombre">العدد : </label>
              <input type="number" class="form-control" name="nombre" value="1" id="nombre" min=1>
            </div>
              <div class="c100">
                <label for="declareur">تبليغ من :</label>
                <select name="declareur" id="declareur">

                  <optgroup label="---">
                    <?php
                     $user = \App\Models\User::where('userrole',2)->get();
                     ?>
                    <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($users->id); ?>"><?php echo e($users->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </optgroup>
                 </select>
            </div>


      <div class="col">
        <button class="btn btn-warning" type="submit">إضافة الاجهاض</button>
      </div>
    </div>
  </form>
    </body>
    <?php echo $__env->make('avorter.historique', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</html>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/ovins/avorter.blade.php ENDPATH**/ ?>