<a {{$attributes->merge([
        'class '=> " card bg-neutral text-neutral-content w-1/4 min-w-62.5"
        ]) }} >
        <div class="card-body ">
            <h2 class="card-title ">  {{ $slot }}  </h2>
        </div>
    </a>

