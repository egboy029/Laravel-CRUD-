<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Admin Dashboard</h2>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Events -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-500 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Events</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $totalEvents }}</p>
                        </div>
                    </div>
                </div>

                <!-- Active Events -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Active Events</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $activeEvents }}</p>
                        </div>
                    </div>
                </div>

                <!-- Trashed Events -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-500 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Trashed Events</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $trashedEvents }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Staff Users -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Staff Users</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Activities -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activities</h3>
                    <div class="space-y-4">
                        @foreach($recentActivities as $activity)
                            <div class="flex items-center justify-between border-b pb-2">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $activity->title }}</p>
                                    <p class="text-sm text-gray-600">by {{ $activity->user->name ?? 'Unknown User' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">{{ $activity->created_at->diffForHumans() }}</p>
                                    <p class="text-sm {{ $activity->deleted_at ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $activity->deleted_at ? 'Trashed' : 'Active' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Events by User -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Events by User</h3>
                    <div class="space-y-4">
                        @foreach($eventsByUser as $userStats)
                            <div class="flex items-center justify-between border-b pb-2">
                                <p class="font-medium text-gray-800">{{ $userStats->name }}</p>
                                <p class="text-lg font-semibold text-gray-600">{{ $userStats->total_events }} events</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Monthly Statistics -->
            <div class="mt-8 bg-white overflow-hidden shadow-xl rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly Event Statistics</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach($monthlyStats as $stat)
                        <div class="text-center p-4 border rounded-lg">
                            <p class="text-sm text-gray-600">{{ date("F", mktime(0, 0, 0, $stat->month, 1)) }} {{ $stat->year }}</p>
                            <p class="text-xl font-semibold text-gray-800">{{ $stat->total }}</p>
                            <p class="text-xs text-gray-600">events</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
