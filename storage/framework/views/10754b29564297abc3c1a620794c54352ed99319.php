<h2> الولادات السابقة </h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">التاريخ</th>
            <th scope="col">الحدث</th>
            <th scope="col">العدد</th>
            <th scope="col">التبليغ من</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $avorternaissances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avorternaissances): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e((string) $avorternaissances->id); ?></th>
                <td><?php echo e($avorternaissances->date); ?></td>
                <td>
                    <?php if($avorternaissances->nas): ?>
                        ولادة
                    <?php else: ?>
                        إجهاض
                    <?php endif; ?>
                </td>
                <td><?php echo e($avorternaissances->nombre); ?></td>
                <td><?php echo e($avorternaissances->name); ?></td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</body>
<?php /**PATH K:\laraval\AppOvins\resources\views/avorter/historique.blade.php ENDPATH**/ ?>