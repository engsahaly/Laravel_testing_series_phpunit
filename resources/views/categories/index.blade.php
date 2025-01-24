<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">
                Add New Category
            </a>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>{{ $categories->firstItem() + $loop->index }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>
                                                <a href="{{ route('categories.show', ['category' => $category]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    Show
                                                </a>

                                                <a href="{{ route('categories.edit', ['category' => $category]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    Edit
                                                </a>

                                                <form
                                                    action="{{ route('categories.destroy', ['category' => $category]) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100%">
                                            <div class="text-danger text-center" role="alert">
                                                No Categories Found
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $categories->appends(request()->query())->render('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
