<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TGSCRUD</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-50 min-h-screen">
            <!-- Navigation -->
            <nav class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <h1 class="text-xl font-bold text-gray-900">Thomasian Gaming Society</h1>
                        </div>
                        <div class="flex items-center">
                            <?php if(Route::has('login')): ?>
                                <div class="space-x-4">
                                    <?php if(auth()->guard()->check()): ?>
                                        <a href="<?php echo e(url('/dashboard')); ?>" class="font-semibold tracking-wide text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login')); ?>" class="mr-10 font-semibold tracking-wide text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                                        <?php if(Route::has('register')): ?>
                                            <a href="<?php echo e(route('register')); ?>" class="font-semibold tracking-wide text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <!-- Your content goes here -->
                <div class="px-4 py-6 sm:px-0">
                    <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 flex items-center justify-center">
                        <h2 class="text-2xl font-bold text-gray-700">Welcome to TGSCRUD</h2>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\clari\OneDrive\Desktop\laravel-crud\resources\views/welcome.blade.php ENDPATH**/ ?>