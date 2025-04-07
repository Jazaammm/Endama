<!-- resources/views/admin/student_list.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">
    @include('auth.admin.sidebar')
    <div class="flex-1 p-10">
        <h2 class="text-3xl font-bold mb-6">STUDENT LIST</h2>
        <div class="bg-white shadow-xl rounded-2xl p-6" style="background-color: #CDCDCD">
            <div class="mb-4 text-right">
                <a href="{{ route('studentlist') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create New Student</a>
            </div>
            <div class="flex justify-between items-center mb-4">
                <form method="GET" action="{{ route('studentlist') }}" class="flex items-center space-x-2">
                    <span>Show</span>
                    <select name="entries" class="border px-2 py-1 rounded" onchange="this.form.submit()">
                        <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span>entries</span>
                </form>
                <form method="GET" action="{{ route('studentlist') }}" class="flex space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="border px-3 py-1 rounded" placeholder="Search">
                    <button type="submit" class="bg-gray-500 text-white px-4 py-1 rounded hover:bg-gray-600">Search</button>
                </form>
            </div>
            <table class="w-full border-collapse border border-black text-left">
                <thead>
                    <tr class="bg-transparent border border-black">
                        <th class="border border-black px-4 py-2">ID</th>
                        <th class="border border-black px-4 py-2">Name</th>
                        <th class="border border-black px-4 py-2">Email</th>
                        <th class="border border-black px-4 py-2">Year Level</th>
                        <th class="border border-black px-4 py-2">Section</th>
                        <th class="border border-black px-4 py-2">Created at</th>
                        <th class="border border-black px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr class="bg-white border border-black" style="background-color:#9c9b9b">
                            <td class="border border-black px-4 py-2">{{ $student->id }}</td>
                            <td class="border border-black px-4 py-2">{{ $student->name }}</td>
                            <td class="border border-black px-4 py-2">{{ $student->email }}</td>
                            <td class="border border-black px-4 py-2">{{ $student->year_level }}</td>
                            <td class="border border-black px-4 py-2">{{ $student->section }}</td>
                            <td class="border border-black px-4 py-2">{{ $student->created_at->format('Y-m-d') }}</td>
                            <td class="border border-black px-4 py-2">
                                <a href="{{ route('editstu', $student->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Edit</a>
                                <form action="{{ route('deletestu', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
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
                {{ $students->links() }}
            </div>
        </div>
    </div>
</body>
</html>
