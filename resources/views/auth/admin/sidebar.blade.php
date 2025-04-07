<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS for rotating the arrow */
        .rotate-90 {
            transform: rotate(90deg);
        }
    </style>
</head>

<body class="bg-gray-100 flex min-h-screen">
    <div class="w-64 bg-[#001840] text-white p-4 flex flex-col min-h-screen">
        <div class="flex items-center justify-center">
            <img src="{{ asset('img/vopolls.png') }}" alt="VoPolls Logo" class="w-40">
        </div>
        <div class="flex items-center space-x-3 p-2 bg-[#002860] rounded-lg mb-8">
            <img src="{{ Auth::user()->photo ? asset('profile_photos/' . Auth::user()->photo) : 'https://via.placeholder.com/150' }}"
                alt="User" class="w-10 h-10 rounded-full">

            <div class="ml-auto relative">
                @auth
                <p class="text-lg font-semibold text-white flex items-center cursor-pointer" id="admin-name">
                    {{ Auth::user()->name }}
                    <span id="arrow" class="ml-20 text-white transform transition-all">&#9654;</span>
                </p>
                @endauth

                <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg text-black hidden">
                    <a href="{{ route('adminprofile') }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Profile</a>
                    <a href="{{ route('accsettings') }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Account Settings</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                    </form>
                </div>

            </div>
        </div>

        <script>
            const dropdown = document.querySelector('#admin-name');
            const menu = document.querySelector('#dropdown-menu');
            const arrow = document.querySelector('#arrow');

            dropdown.addEventListener('click', function() {
                menu.classList.toggle('hidden');
                arrow.classList.toggle('rotate-90');
            });
        </script>

        <ul class="space-y-2 font-medium text-xl items-start justify-start h-screen">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860]  {{ request()->routeIs('admin.dashboard') ? 'bg-[#002860]' : '' }}">
                    <img src="{{ asset('img/dashboard.png') }}" alt="Dashboard Icon" class="w-6 h-6">
                    <span class="ms-3">DASHBOARD</span>
                </a>
            </li>
            <li>
                <a href="{{ route('studentlist') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860]  {{ request()->routeIs('studentlist') ? 'bg-[#002860]' : '' }}">
                    <img src="{{ asset('img/image.png') }}" alt="Student Icon" class="w-6 h-6">
                    <span class="flex-1 ms-3 whitespace-nowrap">STUDENTS</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proflist') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860]  {{ request()->routeIs('proflist') ? 'bg-[#002860]' : '' }}">
                    <img src="{{ asset('img/prof.png') }}" alt="Professor Icon" class="w-6 h-6">
                    <span class="flex-1 ms-3 whitespace-nowrap">PROFESSORS</span>
                </a>
            </li>
        </ul>
    </div>
</body>

</html>
