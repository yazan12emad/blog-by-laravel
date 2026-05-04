@props([
    'name'=>'required'
])

@error($name)
<p class="mt-2 text-sm font-medium text-rose-300">{{ $message }}</p>
@enderror
