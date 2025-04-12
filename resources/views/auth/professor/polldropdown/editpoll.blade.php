<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Poll - Professor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">
    @include('auth.professor.sidebar') <!-- Sidebar inclusion -->

    <!-- Container -->
    <div class="flex-1 p-10">
        <h1 class="text-3xl font-bold mb-10">EDIT POLL</h1>

        <div class="p-6 rounded-md shadow-sm" style="background-color:#D9D9D9">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4" style="color:#4F4D46">EDIT POLL DETAILS</h2>

            <form action="{{ route('update.poll', $poll->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-4 flex items-center justify-center">
                    <label for="title" class="w-32 text-sm font-medium text-gray-700 text-right mr-4">Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $poll->title) }}" class="w-3/4 p-2 border-2 border-[#959386] rounded bg-transparent" required>
                </div>

                <!-- Description -->
                <div class="mb-4 flex items-center justify-center">
                    <label for="description" class="w-32 text-sm font-medium text-gray-700 text-right mr-4">Description:</label>
                    <input type="text" id="description" name="description" value="{{ old('description', $poll->description) }}" class="w-3/4 p-2 border-2 border-[#959386] rounded bg-transparent" required>
                </div>

                <!-- Options -->
                <div class="mb-4 flex items-start justify-center">
                    <label class="w-32 text-sm font-medium text-gray-700 text-right mr-4 pt-2">Options:</label>
                    <div class="w-3/4">
                        <div id="options-container" class="space-y-2">
                            <!-- Existing options from the database will be shown here -->
                            @foreach($poll->options as $option)
                                <div class="relative">
                                    <input type="text" name="options[]" value="{{ old('options[]', $option->title) }}" required class="w-full p-2 pr-10 border-2 border-[#959386] rounded text-sm bg-transparent">
                                    <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-red-500 hover:text-red-600" onclick="this.parentElement.remove();">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <!-- Add Option Button -->
                        <div class="flex justify-end mt-2">
                            <button type="button" onclick="addOption()" class="bg-white px-3 py-1 text-sm font-bold rounded shadow hover:bg-gray-400">
                                Add New Option
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Start and End Date -->
                <div class="mb-4 flex items-center justify-center">
                    <label for="start_date" class="w-32 text-sm font-medium text-gray-700 text-right mr-4">Start Date:</label>
                    <input type="datetime-local" id="start_date" name="start_date"
                    value="{{ old('start_date', \Carbon\Carbon::parse($poll->start_date)->format('Y-m-d\TH:i')) }}"
                    class="w-3/4 p-2 border-2 border-[#959386] rounded bg-transparent" required>

                </div>

                <div class="mb-4 flex items-center justify-center">
                    <label for="end_date" class="w-32 text-sm font-medium text-gray-700 text-right mr-4">End Date:</label>
                    <input type="datetime-local" id="end_date" name="end_date"
                    value="{{ old('end_date', \Carbon\Carbon::parse($poll->end_date)->format('Y-m-d\TH:i')) }}"
                    class="w-3/4 p-2 border-2 border-[#959386] rounded bg-transparent" required>
                </div>

                <!-- Status -->
                <div class="mb-4 flex items-center justify-center">
                    <label for="status" class="w-32 text-sm font-medium text-gray-700 text-right mr-4">Status:</label>
                    <select id="status" name="status" class="w-3/4 p-2 border-2 border-[#959386] rounded bg-transparent">
                        <option value="planned" {{ old('status', $poll->status) == 'planned' ? 'selected' : '' }}>Planned</option>
                        <option value="ongoing" {{ old('status', $poll->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="complete" {{ old('status', $poll->status) == 'complete' ? 'selected' : '' }}>Complete</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="bg-[#001840] text-white px-6 py-2 rounded hover:bg-blue-800">Update</button>
                    <button type="button" onclick="window.location='{{ route($returnRoute) }}'" class="bg-[#54524F] text-white px-6 py-2 rounded hover:bg-gray-500">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function updateOptionPlaceholders() {
            const inputs = document.querySelectorAll('#options-container input[name="options[]"]');
            inputs.forEach((input, index) => {
                input.placeholder = `Option ${index + 1}`;
            });
        }

        function addOption(value = '') {
            const container = document.getElementById('options-container');

            const wrapper = document.createElement('div');
            wrapper.classList.add('relative');

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'options[]';
            input.value = value;
            input.required = true;
            input.placeholder = 'Option';
            input.classList.add('w-full', 'p-2', 'pr-10', 'border-2', 'border-[#959386]', 'rounded', 'text-sm', 'bg-transparent');

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'absolute right-2 top-1/2 transform -translate-y-1/2 text-red-500 hover:text-red-600';
            removeBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            `;
            removeBtn.onclick = () => {
                wrapper.remove();
                updateOptionPlaceholders();
            };

            wrapper.appendChild(input);
            wrapper.appendChild(removeBtn);
            container.appendChild(wrapper);

            updateOptionPlaceholders();
        }
    </script>

</body>
</html>
