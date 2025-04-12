<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">
    @include('auth.professor.sidebar')

    <div class="flex-1 p-10">
        <h2 class="text-3xl font-bold mb-6">PLANNED POLL</h2>
        <div class="bg-white shadow-xl rounded-2xl p-6" style="background-color: #CDCDCD">
            <div class="mb-4 text-right">
                <a href="{{ route('poll.createform') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create New Poll</a>
            </div>
            <div class="flex justify-between items-center mb-4">
                <form method="GET" action="" class="flex items-center space-x-2">
                    <span>Show</span>
                    <select name="entries" class="border px-2 py-1 rounded" onchange="this.form.submit()">
                        <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span>entries</span>
                </form>
                <form method="GET" action="" class="flex space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="border px-3 py-1 rounded" placeholder="Search">
                    <button type="submit" class="bg-gray-500 text-white px-4 py-1 rounded hover:bg-gray-600">Search</button>
                </form>
            </div>
            <table class="w-full border-collapse border border-black text-left">
                <thead>
                    <tr class="bg-transparent border border-black">
                        <th class="border border-black px-4 py-2">ID</th>
                        <th class="border border-black px-4 py-2">Title</th>
                        <th class="border border-black px-4 py-2">Description</th>
                        <th class="border border-black px-4 py-2">Start Date</th>
                        <th class="border border-black px-4 py-2">End Date</th>
                        <th class="border border-black px-4 py-2">Status</th>
                        <th class="border border-black px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($polls as $poll)
                        <tr class="bg-white border border-black" style="background-color:#9c9b9b">
                            <td class="border border-black px-4 py-2">{{ $poll->id }}</td>
                            <td class="border border-black px-4 py-2">{{ $poll->title }}</td>
                            <td class="border border-black px-4 py-2">{{ $poll->description }}</td>
                            <td class="border border-black px-4 py-2">{{ $poll->start_date }}</td>
                            <td class="border border-black px-4 py-2">{{ $poll->end_date }}</td>
                            <td class="border border-black px-4 py-2 capitalize">{{ $poll->status }}</td>
                            <td class="border border-black px-4 py-2">
                                <a href="javascript:void(0)" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600" onclick="viewPoll({{ $poll->id }})">View</a>
                                <a href="{{ route('edit.poll', ['id' => $poll->id, 'return' => 'plannedpoll']) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Edit</a>
                                <form action="" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this poll?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center font-semibold p-4 border border-black">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $polls->links() }}
            </div>
        </div>
    </div>

    <div id="pollModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-gradient-to-r from-gray-800 via-gray-900 to-black rounded-2xl shadow-xl w-full max-w-3xl mx-4 p-6 md:p-8 transform transition-transform duration-300 scale-95">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-6 border-b-2 border-gray-600 pb-4">
                <h3 class="text-3xl font-semibold text-white" id="pollTitle">Poll Title</h3>
                <button onclick="closeModal()" class="text-white hover:text-gray-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="space-y-4 text-gray-300">
                <p><span class="font-semibold">Description:</span> <span id="pollDescription" class="text-gray-400"></span></p>
                <p><span class="font-semibold">Start Date:</span> <span id="pollStartDate" class="text-gray-400"></span></p>
                <p><span class="font-semibold">End Date:</span> <span id="pollEndDate" class="text-gray-400"></span></p>
                <p><span class="font-semibold">Status:</span> <span id="pollStatus" class="text-gray-400 capitalize"></span></p>
            </div>

            <!-- Poll Options -->
            <div class="mt-6">
                <h4 class="text-lg font-semibold text-white mb-4">Poll Options</h4>
                <ul id="pollOptionsList" class="space-y-4 text-gray-200">
                    <!-- Poll options will be dynamically inserted here -->
                </ul>
            </div>

            <!-- Modal Footer -->
            <div class="mt-8 text-right">
                <button onclick="closeModal()" class="bg-blue-700 text-white font-medium px-8 py-3 rounded-md hover:bg-blue-800 transition focus:outline-none">Close</button>
            </div>
        </div>
    </div>



<script>
    function viewPoll(pollId) {
    fetch(`/polls/${pollId}`)
        .then(response => response.json())
        .then(data => {
            // Populate modal with poll data
            document.getElementById('pollTitle').textContent = data.title;
            document.getElementById('pollDescription').textContent = data.description;
            document.getElementById('pollStartDate').textContent = data.start_date;
            document.getElementById('pollEndDate').textContent = data.end_date;
            document.getElementById('pollStatus').textContent = data.status;

            // Populate poll options list
            const optionsList = document.getElementById('pollOptionsList');
            optionsList.innerHTML = ''; // Clear existing options
            data.options.forEach(option => {
                const li = document.createElement('li');
                li.textContent = option.title;
                li.classList.add("px-6", "py-3", "bg-gray-700", "rounded-lg", "hover:bg-gray-600", "cursor-pointer", "transition-colors", "duration-200");
                optionsList.appendChild(li);
            });

            // Show the modal with transition
            const modal = document.getElementById('pollModal');
            modal.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            modal.style.transition = 'opacity 0.3s ease';
        })
        .catch(error => {
            console.error('Error fetching poll data:', error);
        });
}

function closeModal() {
    const modal = document.getElementById('pollModal');
    modal.classList.add('opacity-0', 'pointer-events-none');
    modal.classList.remove('opacity-100');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);  // Delay to allow for fade-out transition
}


</script>




</body>
</html>
