<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Recently Deleted Events</h2>
            <a href="<?php echo e(route('staff.home')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Back to Events
            </a>
        </div>

        <?php if(session('status')): ?>
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->make('components.error-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Trashed Event List -->
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <?php $__empty_1 = true; $__currentLoopData = $trashedEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="p-6 flex space-x-4 items-center">
                    <?php if($event->image): ?>
                        <div class="w-24 h-24 flex-shrink-0">
                            <img src="<?php echo e(asset('storage/' . $event->image)); ?>" 
                                 alt="<?php echo e($event->title); ?>" 
                                 class="w-full h-full object-cover rounded-lg">
                        </div>
                    <?php endif; ?>
                    <div class="flex-grow">
                        <h3 class="text-lg font-medium"><?php echo e($event->title); ?></h3>
                        <p class="text-sm text-gray-600"><?php echo e($event->description); ?></p>
                        <p class="text-sm text-gray-600">Event Date: <?php echo e($event->event_date->format('F j, Y')); ?></p>
                    </div>
                    <div class="flex space-x-2">
                        <form method="POST" action="<?php echo e(route('events.restore', $event->id)); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" 
                                    class="p-2 bg-[#ffffff11] hover:bg-[#ffffff22] rounded-md text-black transition"
                                    title="Restore">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </button>
                        </form>
                        
                        <form method="POST" action="<?php echo e(route('events.force-delete', $event->id)); ?>" 
                              onsubmit="return confirm('Are you sure you want to permanently delete this event? This action cannot be undone.');"
                              class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" 
                                    class="p-2 bg-[#ffffff11] hover:bg-[#ffffff22] rounded-md text-black transition"
                                    title="Delete Permanently">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="p-6 text-center text-gray-500">
                    No deleted events found.
                </div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\clari\OneDrive\Desktop\laravel-crud\resources\views/staff/trash.blade.php ENDPATH**/ ?>