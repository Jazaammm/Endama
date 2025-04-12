<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <nav class="bg-white shadow-sm w-full">
        <div class="w-full px-32 py-4 flex justify-between items-center">
            <!-- LEFT: Logo and School Name -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('img/spcc.png') }}" alt="SPCC Logo" class="w-15 h-15">
                <span class="text-2xl font-bold text-[#001840]">Systems Plus Computer College</span>
            </div>

            <!-- RIGHT: Links and Profile Dropdown -->
            <div class="flex items-center space-x-6 text-lg font-medium text-[#001840] relative">
                <a href="#" class="hover:underline">VOTING</a>
                <span class="text-gray-400">|</span>
                <a href="#" class="hover:underline">POLLING</a>
                <span class="text-gray-400">|</span>
                <a href="{{ route('student.dashboard') }}" class="hover:underline">HOME</a>

                <!-- Profile with dropdown -->
                <div class="relative px-4">
                    <img id="profileBtn"
                        src="{{ Auth::guard('student')->user()->photo ? asset('profile_photos/' . Auth::guard('student')->user()->photo) : 'https://via.placeholder.com/40' }}"
                        alt="Profile"
                        class="w-10 h-10 rounded-full bg-gray-300 object-cover cursor-pointer">

                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu"
                        class="absolute right-0 mt-2 w-52 bg-white text-black rounded-lg shadow-lg hidden z-50">
                        <a href="{{ route('student.profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Account Settings</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        const profileBtn = document.getElementById('profileBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        window.addEventListener('click', (e) => {
            if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>

</body>

</html>
