<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        @include('auth.admin.sidebar')
        <div class="flex-1 p-8">
            <div class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                <a href="#" class="text-blue-500 hover:underline">&larr;</a>
                Admin Profile
            </div>

            <div class="flex flex-col md:flex-row gap-10 items-start">
                <form action="{{ route('admin.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center w-1/3">
                    @csrf
                    @method('PUT')
                    <div class="w-64 h-64 border-2 border-black-300 rounded-md flex items-center justify-center bg-gray-200 overflow-hidden">
                        @if(Auth::user()->photo)
                            <img src="{{ asset('profile_photos/' . Auth::user()->photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 9a3 3 0 100 6 3 3 0 000-6z" />
                                <path fill-rule="evenodd" d="M4.5 5.25A1.5 1.5 0 016 3.75h2.379a1.5 1.5 0 011.06.44l.44.44h4.242l.44-.44a1.5 1.5 0 011.06-.44H18a1.5 1.5 0 011.5 1.5v13.5a1.5 1.5 0 01-1.5 1.5H6a1.5 1.5 0 01-1.5-1.5V5.25zm7.5 10.5a4.5 4.5 0 100-9 4.5 4.5 0 000 9z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </div>

                    <input type="file" name="photo" accept="image/*" class="mt-2 text-sm text-blue-600">
                    <button type="submit" class="mt-1 text-sm text-blue-600 hover:underline">Change photo</button>
                </form>
                
                <div class="bg-white shadow rounded-lg p-6 flex-1 mr-20">
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">About you</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm text-gray-600">Name</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="w-full mt-1 px-4 py-2 bg-gray-100 border rounded" disabled>
                        </div>
                        {{-- <div>
                            <label class="text-sm text-gray-600">Role</label>
                            <input type="text" value="{{ Auth::user()->role }}" class="w-full mt-1 px-4 py-2 bg-gray-100 border rounded" disabled>
                        </div> --}}
                        <div>
                            <label class="text-sm text-gray-600">Email</label>
                            <input type="email" value="{{ Auth::user()->email }}" class="w-full mt-1 px-4 py-2 bg-gray-100 border rounded" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>
