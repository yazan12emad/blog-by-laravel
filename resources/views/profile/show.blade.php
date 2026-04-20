<x-layout title="Profile | laravel">
    <section class="min-h-screen bg-[radial-gradient(circle_at_top,rgba(56,189,248,0.22),transparent_32%),linear-gradient(135deg,#09111f_0%,#111827_50%,#172033_100%)]
     px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-6xl gap-6 lg:grid-cols-[1.05fr_1.35fr]">
            <div
                class="overflow-hidden rounded-4xl border border-white/10 bg-white/8 text-white shadow-2xl backdrop-blur">
                <div
                    class="h-32 bg-[linear-gradient(135deg,rgba(34,197,94,0.85),rgba(59,130,246,0.85),rgba(14,165,233,0.9))]"></div>
                <div class="-mt-16 px-6 pb-8">
                    <div class="flex items-end gap-4">
                        <img
                            id="profilePreview"
                            src="{{ $user->profile_image_url }}"
                            alt="{{ $user->name }}"
                            class="h-28 w-28 rounded-[1.75rem] border-4 border-slate-900 object-cover shadow-xl"
                        >
                        <div class="pb-2">
                            <p class="text-sm uppercase tracking-[0.35em] text-cyan-200/80">Profile</p>
                            <h1 class="mt-1 text-3xl font-black tracking-tight">{{ $user->name }}</h1>
                        </div>
                    </div>

                    <p class="mt-6 text-sm leading-6 text-slate-300">
                        Keep your account details current and use a clear profile image so the rest of the app feels
                        personal and easy to navigate.
                    </p>

                    <div class="mt-8 space-y-4">
                        <div class="rounded-2xl border border-white/10 bg-slate-950/35 p-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Email</p>
                            <p class="mt-2 text-base font-semibold text-white">{{ $user->email }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-slate-950/35 p-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Member Since</p>
                            <p class="mt-2 text-base font-semibold text-white">
                                In {{ $user->created_at?->format('D d M, Y') }}</p>
                        </div>
                        <div class="rounded-2xl border border-cyan-300/25 bg-cyan-400/10 p-4 text-sm text-cyan-100">
                            Leave the password fields empty if you do not want to change your password.
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-4xl border border-slate-200/70 bg-white shadow-2xl shadow-slate-950/20">
                <div class="border-b border-slate-200 px-6 py-6 sm:px-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-sky-600">Edit Details</p>
                    <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-900">Manage your account</h2>
                    <p class="mt-2 max-w-2xl text-sm text-slate-500">
                        Update your name, email, image, and password from a single place with immediate visual feedback.
                    </p>
                </div>

                <form method="post" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data"
                      class="space-y-6 px-6 py-6
                sm:px-8 sm:py-8">
                    @csrf
                    @method('PATCH')

                    @if (session('info'))
                        <div
                            class="rounded-2xl w-fit border border-emerald-200 bg-emerald-50
                             px-4 py-3 text-sm font-medium text-emerald-700">
                            {{ session('info') }}
                        </div>
                    @endif


                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-semibold text-slate-700">User name</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3
                                text-slate-900 outline-none transition focus:border-sky-500 focus:bg-white
                                focus:ring-4 focus:ring-sky-100"
                                placeholder="Your display name"
                                required
                            >
                            <x-error name="name"></x-error>
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100"
                                placeholder="you@example.com"
                                required
                            >
                            <x-error name="email"></x-error>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="profile_image" class="text-sm font-semibold text-slate-700">Profile image</label>
                        <label for="profile_image"
                               class="flex cursor-pointer flex-col items-center justify-center rounded-[1.75rem] border border-dashed
                               border-slate-300 bg-slate-50 px-6 py-8 text-center transition hover:border-sky-400 hover:bg-sky-50">
                            <span class="text-base font-semibold text-slate-800">Choose a new avatar</span>
                            <span id="fileName" class="mt-2 text-sm text-slate-500">PNG, JPG, or WEBP up to 2 MB</span>
                        </label>
                        <input
                            id="profile_image"
                            type="file"
                            name="profile_image"
                            accept=".png,.jpg,.jpeg,.webp"
                            class="hidden"
                        >
                        <x-error name="profile_image"></x-error>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3
                                text-slate-900 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100"
                                placeholder="New password"
                            >
                            <x-error name="password"></x-error>
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-sm font-semibold text-slate-700">Confirm
                                password</label>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3
                                 text-slate-900 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100"
                                placeholder="Repeat new password"
                            >
                        </div>
                    </div>

                    <div
                        class="flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-slate-500">Your changes are applied immediately after you save.</p>
                        <button
                            class="inline-flex items-center justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold
                            text-white transition hover:scale-[1.02] hover:bg-sky-600">
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
