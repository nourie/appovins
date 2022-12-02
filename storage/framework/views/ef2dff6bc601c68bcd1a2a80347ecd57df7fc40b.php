<?php $__env->startSection('title'); ?>
قائمة الحيوانات المحذوفة

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenu'); ?>

<h1> قائمة الحيوانات المحذوفة</h1>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <form action="">
        <div class="form-group">
          <label for="numero">numéro animal</label>
          <input type="number" class="form-control" id="num" aria-describedby="number" placeholder="Enter numéro">
          </div>

        <button type="search" class="btn btn-primary">Submit</button>
      </form>
    <a class="btn btn-danger" href="" role="button">Delete All</a>
    <a class="btn btn-danger" href="" role="button">Delete All trunck</a>

    <table caption="liste table" class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Num</th>
          <th scope="col">Date_achat</th>
          <th scope="col">Poids</th>
          <th scope="col">Sexe</th>

        </tr>
        </thead>
        <tbody>
         <?php $__currentLoopData = $ovins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ovin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <th scope="row">
              <?php echo e($ovin->id); ?></th>
          <td><?php echo e($ovin->num); ?></td>
          <td><?php echo e($ovin->date_achat); ?></td>
          <td><?php echo e($ovin->poid); ?></td>
          <?php if( $ovin->sexe==1): ?>
          <td>Male</td>
          <?php else: ?>
          <td>Female</td>
          <?php endif; ?>

          <td><a class="btn btn-primary" href="<?php echo e(url('ovins/restore/'.$ovin->id)); ?>" role="button" >Restore</a>
              <a class="btn btn-danger"  href="<?php echo e(route('ovins.fdelete',$ovin->id)); ?>" role="button">permDelete</a>
        </td>
        </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/ovins/bin.blade.php ENDPATH**/ ?>