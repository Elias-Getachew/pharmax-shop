<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-2xl mb-6">Post News</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-lg">Title</label>
                <input type="text" name="title" id="title" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-lg">Description</label>
                <textarea name="description" id="description" class="form-textarea mt-1 block w-full" required></textarea>
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-lg">Photo (optional)</label>
                <input type="file" name="photo" id="photo" class="form-input mt-1 block w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Post News</button>
        </form>
    </div>
</x-app-layout>
