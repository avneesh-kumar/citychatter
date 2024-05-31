@extends('admin::layouts.app')

@section('content')
    <div class="flex">
        <div class="flex-1">
            <h1 class="text-gray-700 text-lg font-semibold pb-2 border-b border-gray-700">
                {{ $title }}
            </h1>
        </div>
        <div class="flex-1 items-end text-right">
            <a href="{{ $backUrl }}" class="float-right hover:bg-red-700 bg-red-600 text-white font-bold py-2 px-4  rounded text-xs">
                Back
            </a>
        </div>
    </div>

    <div class="flex">
        <div class="flex-auto mt-8">
            <form action="{{ route('admin.advertisement.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ isset($advertisement) ? $advertisement->id : '' }}" />
                <div class="mb-4 w-1/2">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">
                        Image
                    </label>
                    <input type="file" name="image" id="image" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="{{ isset($advertisement) ? $advertisement->image : old('image') }}" />
                    @if(isset($advertisement) && $advertisement->image)
                        <img src="{{ asset($advertisement->image) }}" alt="" class="w-24 h-24 mt-2" />
                    @endif
                    
                    @error('image')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="url" class="block text-gray-700 text-sm font-bold mb-2">
                        Url
                    </label>
                    <input type="url" name="url" id="url" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="{{ isset($advertisement) ? $advertisement->url : old('url') }}" />
                    @error('url')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="sort_order" class="block text-gray-700 text-sm font-bold mb-2">
                        Sort Order
                    </label>
                    <input type="number" name="sort_order" id="sort_order" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="{{ isset($advertisement) ? $advertisement->sort_order : old('sort_order') }}" />
                    @error('sort_order')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                        Status
                    </label>
                    <select name="status" id="status" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg">
                        <option value="1" {{ isset($advertisement) && $advertisement->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ isset($advertisement) && $advertisement->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4 w-1/2">
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-500 font-bold py-2 px-4 rounded text-xs">
                        {{ isset($advertisement) ? 'Update' : 'Create' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => { 
                    $('#image').next('img').remove();
                    $('#image').after('<img src="'+e.target.result+'" class="w-24 h-24 mt-2" />');
                }
                reader.readAsDataURL(this.files[0]); 
            });
        });
    </script>

@endsection