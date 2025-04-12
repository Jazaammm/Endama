<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
            @auth('professor')
            <img src="{{ Auth::guard('professor')->user()->photo ? asset('prof_photos/' . Auth::guard('professor')->user()->photo) : 'https://via.placeholder.com/150' }}"
                alt="User" class="w-10 h-10 rounded-full">
            @else
            <img src="https://via.placeholder.com/150" alt="Guest" class="w-10 h-10 rounded-full">
            @endauth

            <div class="ml-auto relative">
                @auth('professor')
                <p class="text-lg font-semibold text-white flex items-center cursor-pointer" id="admin-name">
                    {{ Auth::guard('professor')->user()->name }}
                    <span id="arrow" class="ml-20 text-white transform transition-all">&#9654;</span>
                </p>
                @endauth

                <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg text-black hidden">
                    <a href="{{ route('prof.profile') }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Profile</a>
                    <a href="{{ route('prof.settings') }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Account Settings</a>
                    <!-- Logout Form -->
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
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
                <a href="{{ route('prof.dashboard') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860] {{ request()->routeIs('prof.dashboard') ? 'bg-[#002860]' : '' }}">
                    <img src="{{ asset('img/dashboard.png') }}" alt="Dashboard Icon" class="w-6 h-6">
                    <span class="ms-3">DASHBOARD</span>
                </a>
            </li>
            <li x-data="{ open: {{ request()->routeIs('plannedpoll', 'poll.ongoing', 'poll.completed') ? 'true' : 'false' }} }">
                <button @click="open = !open" type="button" class="flex items-center w-full p-2 text-white rounded-lg hover:bg-[#002860]">
                    <img src="{{ asset('img/poll.png') }}" alt="Poll Icon" class="w-6 h-6">
                    <span class="flex-1 ms-3 text-left">POLLING</span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <ul x-show="open" x-transition class="pl-12 mt-2 space-y-2 text-sm text-white">
                    <li>
                        <a href="{{ route('plannedpoll') }}" class="block p-2 rounded-lg hover:bg-[#002860] {{ request()->routeIs('plannedpoll') ? 'bg-[#002860]' : '' }}">Planned</a>
                    </li>
                    <li>
                        <a href="{{ route('poll.ongoing') }}" class="block p-2 rounded-lg hover:bg-[#002860] {{ request()->routeIs('poll.ongoing') ? 'bg-[#002860]' : '' }}">Ongoing</a>
                    </li>
                    <li>
                        <a href="{{ route('poll.completed') }}" class="block p-2 rounded-lg hover:bg-[#002860] {{ request()->routeIs('poll.completed') ? 'bg-[#002860]' : '' }}">Complete</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860] {{ request()->routeIs('') ? 'bg-[#002860]' : '' }}">
                    <img src="{{ asset('img/vote.png') }}" alt="Professor Icon" class="w-6 h-6">
                    <span class="flex-1 ms-3 whitespace-nowrap">VOTING</span>
                </a>
            </li>
            <li>
                <a href="{{ route('viewstudentlist') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860] {{ request()->routeIs('') ? 'bg-[#002860]' : '' }}">
                    <img src="{{ asset('img/image.png') }}" alt="Student Icon" class="w-6 h-6">
                    <span class="flex-1 ms-3 whitespace-nowrap">STUDENTS</span>
                </a>
            </li>
        </ul>
    </div>
</body>

</html>
