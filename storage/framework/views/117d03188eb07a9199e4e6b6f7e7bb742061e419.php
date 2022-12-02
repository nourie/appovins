<?php $__env->startSection('title'); ?>
    إعادة الحيوانات
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenu'); ?>

    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">

                <div class="col-xl-2">


                    <p class="text-muted">الحيوان</p>
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form class="form-control me-2" action="<?php echo e(route('achat.search')); ?>" method="GET" role="search">
                        <?php echo e(method_field('get')); ?>

                        <?php echo e(csrf_field()); ?>


                        <ul class="list-unstyled">
                            <?php if(count($temps) > 0): ?>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold"><input class="form-control me-2" type="date" name="date_retour"
                                            value="<?php echo e($temps[0]->date_retour); ?>" required></li>
                            <?php else: ?>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold"><input class="form-control me-2" type="date" name="date_retour"
                                            value="<?php echo e(date('Y-m-d')); ?>" required></li>
                            <?php endif; ?>



                            <li class="text-muted">
                                <?php echo e($error); ?>

                                <input class="form-control me-2" type="text" placeholder="الرقم" aria-label="البحث"
                                    name="num" required value=<?php echo e(old('num')); ?>>
                                <i class="fas fa-circle" style="color:#84B0CA ;"> السعر</i> <span class="fw-bold">
                                    <input class="form-control me-2" type="number" min=0 step="0.01" placeholder="السعر"
                                        aria-label="البحث" name="prix_retour" required value=<?php echo e(old('prix_retour')); ?>>
                                    <input type="hidden" name="avoir" value="1">
                            </li>
                            <li>
                                <div class="c100">
                                    <label for="id_vendeur">البائع:</label>

                                    <select name="id_vendeur" id="id_vendeur">

                                        <optgroup label="---">
                                            <?php
                                                if (count($temps) > 0) {
                                                    $users = \App\Models\User::where('id', $temps[0]->id_vendeur)->get();
                                                } else {
                                                    $users = \App\Models\User::where('userrole', 3)->get();
                                                }
                                            ?>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </optgroup>
                                    </select>

                                </div>

                                <button class="btn btn-outline-success" type="submit">إعادة</button>
                            </li>


                        </ul>
                    </form>
                </div>
            </div>
            <div class="row d-flex align-items-baseline">
                <div class="col-xl-9">
                    <p style="color: #7e8d9f;font-size: 20px;"> <strong>إعادة الحيوانات</strong></p>
                </div>
                <div class="col-xl-3 float-end">
                    <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                            class="fas fa-print text-primary"></i> طباعة</a>
                    <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                            class="far fa-file-pdf text-danger"></i> تصدير</a>
                </div>
                <hr>
            </div>

            <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                    <thead style="background-color:#84B0CA ;" class="text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الرقم</th>
                            <th scope="col">السعر</th>
                            <th scope="col">الجنس</th>
                            <th scope="col">تاريخ الشراء</th>
                            <th scope="col">تاريخ الولادة </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $__currentLoopData = $temps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th scope="row"><?php echo e($temp->id); ?></th>
                                <td><?php echo e($temp->num); ?></td>
                                <td><?php echo e($temp->prix_retour); ?></td>
                                <?php if($temp->sexe == 1): ?>
                                    <td>ذكر</td>
                                <?php else: ?>
                                    <td>أنثى</td>
                                <?php endif; ?>

                                <td><?php echo e($temp->date_achat); ?></td>
                                <td><?php echo e($temp->date_naissance); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                        <tr>
                            <td> عدد الحيوانات :<?php echo e($nombres); ?></td>
                            <td>..</td>
                            <td>الثمن الكلي :<?php echo e($total); ?></td>
                            <td> كباش: <?php echo e($nombremale); ?> | نعاج:</span><?php echo e($nombrefemale); ?>|خراف :<?php echo e($nombreagneaux); ?>

                            </td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="row">

                <div class="col-xl-3">
                    <ul class="list-unstyled">
                        <li class="text-muted ms-3">


                            <span class="text-black me-2">
                                <span class="text-black me-2">


                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">

                <div class="col-xl-2">
                    <a type="button" class="btn btn-primary text-capitalize" style="background-color:#60bdf3 ;"
                        href="<?php echo e(route('achat.valider')); ?>">تأكيد الإعادة
                    </a>


                </div>
            </div>

        </div>
    </div>
    </div>
    </div>

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

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH K:\laraval\AppOvins\resources\views/achat/avoirachat.blade.php ENDPATH**/ ?>