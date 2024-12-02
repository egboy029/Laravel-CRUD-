<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Admin Dashboard</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <!-- Total Events -->
                    <div>
                        <h3 class="text-base font-medium text-gray-900">Total Events</h3>
                        <p class="mt-1 text-2xl font-semibold text-indigo-600">{{ $totalEvents }}</p>
                    </div>

                    <!-- Active Events -->
                    <div>
                        <h3 class="text-base font-medium text-gray-900">Active Events</h3>
                        <p class="mt-1 text-2xl font-semibold text-green-600">{{ $activeEvents }}</p>
                    </div>

                    <!-- Upcoming Events -->
                    <div>
                        <h3 class="text-base font-medium text-gray-900">Upcoming Events</h3>
                        <p class="mt-1 text-2xl font-semibold text-blue-600">{{ $upcomingEvents }}</p>
                    </div>

                    <!-- Past Events -->
                    <div>
                        <h3 class="text-base font-medium text-gray-900">Past Events</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-600">{{ $pastEvents }}</p>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activities</h3>
                    <div class="space-y-4">
                        @forelse($recentActivities as $activity)
                            <div class="border-b border-gray-200 pb-4">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <h4 class="text-base font-medium text-gray-900">{{ $activity['title'] }}</h4>
                                            <span class="px-2 py-1 text-xs font-medium rounded-md
                                                @if($activity['status'] === 'upcoming') bg-blue-100 text-blue-800
                                                @elseif($activity['status'] === 'active') bg-green-100 text-green-800
                                                @elseif($activity['status'] === 'past') bg-gray-100 text-gray-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($activity['status']) }}
                                            </span>
                                        </div>
                                        <div class="mt-1 text-sm text-gray-500">
                                            Created by {{ $activity['user']['name'] }} • {{ $activity['user']['role'] }}
                                        </div>
                                        <div class="mt-1 text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($activity['event_date'])->format('M d, Y g:i A') }}
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500">
                                <p>No recent activities</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
