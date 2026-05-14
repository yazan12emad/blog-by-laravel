<x-layout title="Profile | laravel">
    <section class="space-y-6">
        <div class="rounded-3xl border border-slate-800 bg-slate-900 px-6 py-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-center">
                <img
                    id="profilePreview"
                    src="{{ $user->profile_image_url }}"
                    alt="{{ $user->name }}"
                    class="h-24 w-24 rounded-3xl border border-slate-700 object-cover"
                >

                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.22em] text-slate-400">Profile</p>
                    <h1 class="mt-2 text-3xl font-bold text-white">{{ $user->name }}</h1>
                    <p class="mt-2 text-sm leading-7 text-slate-400">
                        Update your account details from one simple screen.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[0.9fr_1.4fr]">
            <div class="space-y-4 rounded-3xl border border-slate-800 bg-slate-900 p-6">
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-4">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Email</p>
                    <p class="mt-2 text-base font-semibold text-white">{{ $user->email }}</p>
                </div>

                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-4">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Member since</p>
                    <p class="mt-2 text-base font-semibold text-white">{{ $user->created_at?->format('D d M, Y') }}</p>
                </div>

                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-4 text-sm leading-6 text-slate-400">
                    Leave the password fields empty if you do not want to change the password.
                </div>
            </div>

            <div class="rounded-3xl border border-slate-800 bg-slate-900">
                <div class="border-b border-slate-800 px-6 py-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.22em] text-slate-400">Edit details</p>
                    <h2 class="mt-2 text-2xl font-bold text-white">Manage your account</h2>
                </div>

                <form method="post" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" class="space-y-6 px-6 py-6">
                    @csrf
                    @method('PATCH')

                    <x-status_message></x-status_message>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-slate-300">User name</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                                placeholder="Your display name"
                                required
                            >
                            <x-error name="name"> </x-error>
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-slate-300">Email</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                                placeholder="you@example.com"
                                required
                            >
                            <x-error name="email"> </x-error>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="profile_image" class="text-sm font-medium text-slate-300">Profile image</label>
                        <label for="profile_image"
                               class="flex cursor-pointer flex-col items-center justify-center rounded-3xl border border-dashed border-slate-700 bg-slate-950 px-6 py-8 text-center transition hover:border-slate-500">
                            <span class="text-base font-semibold text-white">Choose a new avatar</span>
                            <span id="fileName" class="mt-2 text-sm text-slate-400">PNG, JPG, or WEBP up to 2 MB</span>
                        </label>
                        <input
                            id="profile_image"
                            type="file"
                            name="profile_image"
                            accept=".png,.jpg,.jpeg,.webp"
                            class="hidden"
                        >
                        <x-error name="profile_image"> </x-error>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-medium text-slate-300">
                                Password
                            </label>

                            <div class="relative">
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 pr-12
            text-white outline-none transition focus:border-slate-500"
                                    placeholder="New password"
                                >
                                <!-- Eye Button -->
                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white"
                                >
                                    <!-- Eye Icon -->
                                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg"
                                         width="20" height="20" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>

                                    <!-- Eye Off Icon -->
                                    <svg id="eyeClosed" class="hidden"
                                         xmlns="http://www.w3.org/2000/svg"
                                         width="20" height="20" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575"/>
                                        <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/>
                                        <path d="m2 2 20 20"/>
                                    </svg>
                                </button>
                            </div>

                            <x-error name="password"></x-error>
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-sm font-medium text-slate-300">Confirm password</label>
                            <div class="relative">
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                                placeholder="Repeat new password"
                            >
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-slate-800 pt-6 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-slate-400">Save your changes when you are ready.</p>
                        <button class="inline-flex items-center justify-center rounded-2xl bg-white px-6 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                            Save profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        const imageInput = document.getElementById('profile_image');
        const imagePreview = document.getElementById('profilePreview');
        const fileName = document.getElementById('fileName');


        imageInput?.addEventListener('change', (event) => {
            const [file] = event.target.files;

            if (!file) {
                fileName.textContent = 'PNG, JPG, or WEBP up to 2 MB';
                return;
            }

            fileName.textContent = file.name;
            imagePreview.src = URL.createObjectURL(file);
        });


    </script>
</x-layout>
