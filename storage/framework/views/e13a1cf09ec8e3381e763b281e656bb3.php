<?php if($errors->any()): ?>
    <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-md">
        <ul class="list-disc list-inside">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-md">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\Users\clari\OneDrive\Desktop\laravel-crud\resources\views/components/error-message.blade.php ENDPATH**/ ?>