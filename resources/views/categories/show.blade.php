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
                    
                    {{-- MODIFICATIONS FROM HERE --}}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Name</label>
                            <p class="border form-control">{{ $category->name ?? '--' }}</p>
                        </div>
                    
                        <div class="form-group col-md-6">
                            <label class="form-label">Description</label>
                            <p class="border form-control">{{ $category->description ?? '--' }}</p>
                        </div>
                    </div>
                    {{-- MODIFICATIONS TO HERE --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>