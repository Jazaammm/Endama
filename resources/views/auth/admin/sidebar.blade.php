<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex min-h-screen">
    <div class="w-64 bg-[#001840] text-white p-4 flex flex-col min-h-screen">
        <div class="flex items-center justify-center">
            <img src="{{ asset('img/vopolls.png') }}" alt="VoPolls Logo" class="w-40">
        </div>
        <div class="flex items-center space-x-3 p-2 bg-[#002860] rounded-lg mb-8">
            <img src="user-profile-url.jpg" alt="User" class="w-10 h-10 rounded-full">
            <div>
                @auth
                <p class="text-lg font-semibold text-white">{{ Auth::user()->name }}</p>
                @endauth
            </div>
        </div>

        <ul class="space-y-2 font-medium text-xl items-start justify-start h-screen">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860] dark:hover:bg-gray-700 group">
                    <img src="{{ asset('img/dashboard.png') }}" alt="Dashboard Icon" class="w-6 h-6">
                    <span class="ms-3">DASHBOARD</span>
                </a>
            </li>

            <!-- Students Image Icon -->
            <li>
                <a href="#" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860] dark:hover:bg-gray-700 group">
                    <img src="{{ asset('img/image.png') }}" alt="Student Icon" class="w-6 h-6">
                    <span class="flex-1 ms-3 whitespace-nowrap">STUDENTS</span>
                </a>
            </li>

            <!-- Professors Image Icon -->
            <li>
                <a href="{{ route('proflist') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860] dark:hover:bg-gray-700 group">
                    <img src="{{ asset('img/prof.png') }}" alt="Professor Icon" class="w-6 h-6">
                    <span class="flex-1 ms-3 whitespace-nowrap">PROFESSORS</span>
                </a>
            </li>
        </ul>
    </div>
</body>

</html>
