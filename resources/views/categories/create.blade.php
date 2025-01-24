<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-light">
                Back
            </a>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    
                        {{-- MODIFICATIONS FROM HERE --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="border form-control" name="name" placeholder="Name...">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                    
                            <div class="form-group col-md-6">
                                <label class="form-label">Description</label>
                                <input type="text" class="border form-control" name="description" placeholder="Description...">
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- MODIFICATIONS TO HERE --}}
                    
                        <div class="form-group float-right mt-2">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>



