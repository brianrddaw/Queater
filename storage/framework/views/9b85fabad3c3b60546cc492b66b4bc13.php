<div class="slider-container sticky top-0 flex items-center justify-between  w-full h-20  z-10 overflow-x-scroll pl-2 bg-stone-100">
    <div class="absolute flex gap-4 p-2">
        <?php $__currentLoopData = $productsByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="#<?php echo e($category); ?>" class="category text-orange-950 select-none font-semibold py-2 px-2 rounded cursor-pointer bg-stone-200 hover:bg-slate-800 hover:text-orange-50 uppercase transition-all"><?php echo e($category); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <span>
        </span>
    </div>
</div>
<?php /**PATH C:\Users\Programación\Desktop\miguel\resources\views/user-views/components/slide-bar-component.blade.php ENDPATH**/ ?>