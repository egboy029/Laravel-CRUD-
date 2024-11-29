@if ($errors->any())
    <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-md">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-md">
        {{ session('error') }}
    </div>
@endif
