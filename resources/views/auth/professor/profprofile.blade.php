<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        @include('auth.professor.sidebar')
        <div class="flex-1 p-8">
            <div class="text-4xl font-bold text-gray-800 mb-6 flex items-center gap-2" style="color:#001840">
                <a href="{{ route('prof.dashboard') }}" class="text-blue-500 hover:underline text-2xl">&larr;</a>
                Professor Profile
            </div>

            <div class="flex flex-col md:flex-row gap-10 items-start mt-16">
                <form action="{{ route('prof.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center w-full md:w-1/2 lg:w-1/3 mt-8">
                    @csrf
                    @method('PUT')
                    <div class="w-80 h-80 border-2 border-gray-300 rounded-lg flex items-center justify-center bg-gray-200 overflow-hidden">
                        <img id="previewImage"
                             src="{{ Auth::guard('professor')->user()->photo ? asset('prof_photos/' . Auth::guard('professor')->user()->photo) : '' }}"
                             alt="Profile Photo"
                             class="w-full h-full object-cover {{ Auth::guard('professor')->user()->photo ? '' : 'hidden' }}">

                        @if (!Auth::guard('professor')->user()->photo)
                            <svg id="defaultIcon" xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 9a3 3 0 100 6 3 3 0 000-6z" />
                                <path fill-rule="evenodd" d="M4.5 5.25A1.5 1.5 0 016 3.75h2.379a1.5 1.5 0 011.06.44l.44.44h4.242l.44-.44a1.5 1.5 0 011.06-.44H18a1.5 1.5 0 011.5 1.5v13.5a1.5 1.5 0 01-1.5 1.5H6a1.5 1.5 0 01-1.5-1.5V5.25zm7.5 10.5a4.5 4.5 0 100-9 4.5 4.5 0 000 9z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </div>

                    <input type="file" name="photo" accept="image/*" class="mt-4 w-full text-sm text-blue-600 border rounded px-4 py-2 cursor-pointer" onchange="previewFile(event)">
                    <button type="submit" class="mt-3 bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 transition">
                        Change Photo
                    </button>
                </form>


                <div class="bg-white shadow rounded-lg p-6 flex-1 mr-20 min-h-[400px]">
                    <h3 class="text-3xl font-bold mb-6 border-b pb-3">About you</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="text-lg text-gray-700">Name</label>
                            <input type="text" value="{{ Auth::guard('professor')->user()->name }}" class="w-full mt-2 px-5 py-3 text-lg bg-gray-100 border rounded" disabled>
                        </div>

                        {{-- <div>
                            <label class="text-lg text-gray-700">Role</label>
                            <input type="text" value="{{ Auth::user()->role }}" class="w-full mt-2 px-5 py-3 text-lg bg-gray-100 border rounded" disabled>
                        </div> --}}

                        <div>
                            <label class="text-lg text-gray-700">Email</label>
                            <input type="email" value="{{ Auth::guard('professor')->user()->email }}" class="w-full mt-2 px-5 py-3 text-lg bg-gray-100 border rounded" disabled>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>
            function previewFile(event) {
                const input = event.target;
                const file = input.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const previewImage = document.getElementById('previewImage');
                        const defaultIcon = document.getElementById('defaultIcon');
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        if (defaultIcon) defaultIcon.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>

</body>

</html>
