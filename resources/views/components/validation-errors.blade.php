@if($errors->any())
    <div class="mb-4 p-4 bg-rose-100 rounded-lg">
        <ul class="list-disc list-inside text-sm text-rose-600">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
