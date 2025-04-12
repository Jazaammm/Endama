<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">
    @include('auth.professor.sidebar')
    <div class="flex-1 p-10">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('prof_photos/' . Auth::guard('professor')->user()->photo) }}"
                     alt="Profile Photo"
                     class="w-24 h-24 rounded-full object-cover border-4 border-black-200 shadow">
                <h2 class="text-2xl font-bold mt-4">Account Settings</h2>
            </div>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('prof.changepass') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', Auth::guard('professor')->user()->name) }}"
                           class="w-full border border-gray-300 p-2 rounded">
                    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::guard('professor')->user()->email) }}"
                           class="w-full border border-gray-300 p-2 rounded">
                    @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">New Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 p-2 rounded">
                    @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="w-full border border-gray-300 p-2 rounded" >
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
