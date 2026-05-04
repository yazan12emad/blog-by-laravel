
@if (session('Success'))
    <div class="rounded-2xl border border-emerald-800 bg-emerald-950/40 px-4 py-3 text-sm font-medium text-emerald-200">
        {{ session('Success') }}
    </div>
@endif

@if (session('Pending'))
    <div class="rounded-2xl border border-orange-300 bg-orange-900 px-4 py-3 text-sm font-medium text-white">
        {{ session('Pending') }}
    </div>
@endif

@if (session('Failed'))
    <div class="rounded-2xl border border-red-100 bg-emerald-950/40 px-4 py-3 text-sm font-medium text-emerald-200">
        {{ session('Failed') }}
    </div>
@endif

