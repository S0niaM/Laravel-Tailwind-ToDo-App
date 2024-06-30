@extends('layouts.app')

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 md:px-8">
    <div class="flex justify-between items-center mb-4"> <!-- Flex container for button and table -->
        <button id= 'add-new-button'class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
<span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
Add New
</span>
</button>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">SL No.</th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Type
                        <a href="#">
                            <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .10-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                            </svg>
                        </a>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Actions</th>
                <th scope="col" class="px-6 py-3">Date and Time</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1; @endphp
            @foreach ($items as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $counter++ }}</td>
                    <td class="px-6 py-4">{{ $item->type }}</td>
                    <td class="px-6 py-4">{{ $item->des }}</td>
                    <td class="px-6 py-4"><input type="checkbox" name="item_ids[]" value="{{ $item->id }}"></td>
                    <td class="px-6 py-4 flex gap-2">
                        
                    <form action="{{ route('items.update', $item->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="button" class=" edit-button text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-3 py-1.5 text-center me-2 mb-2" data-id="{{ $item->id }}" data-type="{{ $item->type }}" data-des="{{ $item->des }}">Edit</button>
                    </form>

                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-3 py-1.5 text-center me-2 mb-2">Delete</button>
                    </form>

                    <td class="px-6 py-4">{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ADD Modal -->
<div id="add-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 class="text-2xl mb-4">Add New Item</h2>
            <form action="{{ route('items.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <input type="text" name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="des" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="des" id="des" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="close-modal" class="mr-2 text-gray-700">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="edit-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <form id="edit-form" action="{{ route('items.update', $item->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <input type="text" name="type" id="type" value="{{ $item->type }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="des" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="des" id="des" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>{{ $item->des }}</textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="close-edit-modal" class="mr-2 text-gray-700">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-new-button').addEventListener('click', function() {
        document.getElementById('add-modal').classList.remove('hidden');
    });

    document.getElementById('close-modal').addEventListener('click', function() {
        document.getElementById('add-modal').classList.add('hidden');
    });

    // Attach event listeners to all edit buttons
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-id');
            const itemType = this.getAttribute('data-type');
            const itemDes = this.getAttribute('data-des');

            const formAction = `/items/${itemId}`;
            const editForm = document.getElementById('edit-form');
            editForm.action = formAction;
            editForm.querySelector('input[name="type"]').value = itemType;
            editForm.querySelector('textarea[name="des"]').value = itemDes;

            document.getElementById('edit-modal').classList.remove('hidden');
        });
    });

    document.getElementById('close-edit-modal').addEventListener('click', function() {
        document.getElementById('edit-modal').classList.add('hidden');
    });
</script>
@endsection
