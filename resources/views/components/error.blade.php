@props([
    'name'=>'required'
])

@error($name)
<p class="text-sm text-red-700 font-bold"> {{ $message }}</p>
@enderror
