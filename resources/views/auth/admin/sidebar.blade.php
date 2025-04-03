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
        <div class="flex items-center justify-center ">
            <img src="{{ asset('img/vopolls.png') }}" alt="VoPolls Logo" class="w-40">
        </div>
        <div class="relative flex items-center space-x-3 p-2 bg-[#002860] rounded-lg mb-8">
            <img src="user-profile-url.jpg" alt="User" class="w-10 h-10 rounded-full">
            <div>
                <p class="text-sm font-semibold text-white">Username</p>
                <p class="text-xs text-gray-300">User Role</p>
            </div>

            <!-- Dropdown Button -->
            <button id="dropdownToggle" class="ml-auto text-white focus:outline-none">
                ▼ <!-- You can replace this with an SVG arrow icon -->
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdownMenu" class="absolute right-0 mt-12 bg-white shadow-md rounded-md w-40 hidden">
                <a href="/account-settings" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
            </div>
        </div>

        <script>
            document.getElementById('dropdownToggle').addEventListener('click', function () {
                let menu = document.getElementById('dropdownMenu');
                menu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                let dropdown = document.getElementById('dropdownMenu');
                let toggle = document.getElementById('dropdownToggle');

                if (!dropdown.contains(event.target) && !toggle.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        </script>


            <ul class="space-y-2 font-medium text-xl  items-start justify-start h-screen">
          <li>
             <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860] dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                   <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                   <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Dashboard</span>
             </a>
          </li>

          <li>
             <a href="#" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860] dark:hover:bg-gray-700 group">
                <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                   <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Students</span>
             </a>
          </li>
          <li>
             <a href="{{ route('proflist') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-[#002860] dark:hover:bg-gray-700 group">
                <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                   <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Professors</span>
             </a>
          </li>

       </ul>

    </div>
</body>
</html>
