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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ showImage: false, imageSrc: '' }">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Events</h2>
                <?php echo $__env->make('staff.partials.create-event-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <a href="<?php echo e(route('events.trash')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    View Trash
                </a>
            </div>

            <?php if(session('status')): ?>
                <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php echo $__env->make('components.error-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Event List -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg transition duration-500 hover:shadow-2xl hover:scale-[1.015]">
                        <?php if($event->image): ?>
                            <div class="h-48 overflow-hidden cursor-pointer"
                                 @click="showImage = true; imageSrc = '<?php echo e(asset('storage/' . $event->image)); ?>'">
                                <img src="<?php echo e(asset('storage/' . $event->image)); ?>" 
                                     alt="<?php echo e($event->title); ?>" 
                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                        <?php endif; ?>
                        <div class="main p-4">
                            <h3 class="text-lg font-medium text-gray-800"><?php echo e($event->title); ?></h3>
                            <hr class="border-gray-200 my-2">
                            <p class="text-gray-600 text-sm"><?php echo e($event->description); ?></p>
                            
                            <div class="tokenInfo flex justify-between items-center mt-4">
                                <div class="duration flex items-center text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="ml-2"><?php echo e($event->event_date->format('F j, Y')); ?></span>
                                </div>
                            </div>

                            <div class="flex space-x-2 mt-4">
                                <a href="<?php echo e(route('events.edit', $event)); ?>" 
                                   class="p-2 bg-[#ffffff11] hover:bg-[#ffffff22] rounded-md text-black transition"
                                   title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form method="POST" action="<?php echo e(route('events.destroy', $event)); ?>" 
                                      onsubmit="return confirm('Are you sure you want to move this event to trash?');" 
                                      class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="p-2 bg-[#ffffff11] hover:bg-[#ffffff22] rounded-md text-black transition"
                                            title="Move to Trash">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Image Modal -->
            <div x-show="showImage" 
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90"
                 @click="showImage = false"
                 @keydown.escape.window="showImage = false"
                 style="display: none;">
                <div class="relative">
                    <img :src="imageSrc" 
                         class="max-w-none w-auto h-auto"
                         @click.stop>
                    <button @click="showImage = false" 
                            class="absolute top-4 right-4 text-white hover:text-gray-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
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
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<?php /**PATH C:\Users\clari\OneDrive\Desktop\laravel-crud\resources\views/staff/home.blade.php ENDPATH**/ ?>