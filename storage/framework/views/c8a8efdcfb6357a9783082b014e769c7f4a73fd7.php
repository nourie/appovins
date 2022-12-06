<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title> تتبع القطيع - <?php echo $__env->yieldContent('title'); ?></title>
    <meta charset="utf-8">
    <meta name="viewport " content="width=device-width, initial-scale=.8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>



</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">





        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">






            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/ovins/public/ovins">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo e(url('/dashboard')); ?>">لوحة التحكم</a>
                </li>


                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        شراء
                    </button>
                    <ul class="dropdown-menu">
                        <center>
                            <?php if(auth()->user()->userrole == 1): ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('achat.achat')); ?>">شراء</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('achat.index')); ?>">قائمة الشراء</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('achat.avoir')); ?>">إعادة</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('achat.indexavoir')); ?>">قائمة
                                        الإعادات</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('achat.index')); ?>">قائمة الشراء</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('achat.indexavoir')); ?>">قائمة
                                        الإعادات</a></li>
                            <?php endif; ?>
                        </center>

                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        بيع
                    </button>

                    <ul class="dropdown-menu">
                        <center>
                            <?php if(auth()->user()->userrole == 1): ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('vente.index')); ?>">بيع</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="<?php echo e(route('vente.show', 1)); ?>">قائمة البيع</a></li>
                        </center>
                    </ul>

                </div>
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        قوائم
                    </button>
                    <ul class="dropdown-menu ">
                        <center>
                            <li><a class="dropdown-item" href="<?php echo e(route('naissance.index')); ?>"> الولادات</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('avorter.index')); ?>"> الاجهاضات</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('die.index')); ?>"> الأغنام النافقة</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('die.index2')); ?>"> المواليد النافقة</a></li>
                        </center>

                    </ul>
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('ovins.index')); ?>">قائمة المرقمة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('ovins.agneaulist')); ?>">المواليد</a>
                </li>
                <li class="nav-item">
                </li>
                <div>
                    <form class="d-flex" action="<?php echo e(route('ovins.search')); ?>" method="GET" role="search">
                        <?php echo e(method_field('get')); ?>

                        <?php echo e(csrf_field()); ?>

                        <input class="form-control me-2" type="search" placeholder="بحث" aria-label="البجث"
                            name="q">
                        <button class="btn btn-outline-success" type="submit">إبحث</button>
                    </form>
                </div>
            </ul>
        </div>
    </nav>
</body>

</html>
<?php echo $__env->yieldContent('contenu'); ?>
<?php $__env->startSection('sidebar'); ?>
    <h1> <i class="fa fa-copyright" aria-hidden="true"> SARL ZIDANI LIL TATWIR AL FILAHI Copyright © <?php echo e(date('Y')); ?>

        </i>
    </h1>
<?php echo $__env->yieldSection(); ?>
<?php /**PATH K:\laraval\AppOvins\resources\views/layouts/menu.blade.php ENDPATH**/ ?>