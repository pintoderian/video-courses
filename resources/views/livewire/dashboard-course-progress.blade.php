<div>
    @if($isAdmin)
    <div class="overflow-x-auto mb-6">
        <h2 class="text-xl font-semibold mb-4">Admin View: User Progress</h2>

        @foreach($users as $user)
        <h3 class="text-lg font-semibold mb-2">{{ $user->name }}'s Progress</h3>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-6">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">Course</th>
                    <th class="px-6 py-3">Progress</th>
                    <th class="px-6 py-3">Current Video</th>
                    <th class="px-6 py-3">Progress Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $course->name }}</td>
                    <td class="px-6 py-4">
                        {{ $userProgress[$user->id][$course->id]['progress'] }}
                    </td>
                    <td class="px-6 py-4">{{ $userProgress[$user->id][$course->id]['current_video'] }}</td>
                    <td class="px-6 py-4">
                        {{ $userProgress[$user->id][$course->id]['percentage'] }}%
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
    @endif

    <!-- Tabla para el Usuario logueado -->
    @if(!$isAdmin)
    <div class="overflow-x-auto">
        <h2 class="text-xl font-semibold mb-4">Your Course Progress</h2>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">Course</th>
                    <th class="px-6 py-3">Progress Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $course->name }}</td>
                    <td class="px-6 py-4">
                        {{ $userProgress[$course->id]['percentage'] ?? '0' }}%
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>