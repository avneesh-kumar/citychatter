@extends('admin::layouts.app')

@section('content')
    <div class="flex">
        <div class="flex-1">
            <h1 class="text-gray-700 text-lg font-semibold pb-2 border-b border-gray-700">
                {{ $title }}
            </h1>
        </div>
        <div class="flex-1 items-end text-right">
            <button type="button"  class="float-right hover:bg-blue-700 bg-blue-600 text-white font-bold py-2 px-4 rounded text-xs ml-2" data-drawer-target="drawer-filter" data-drawer-show="drawer-filter" data-drawer-placement="right" aria-controls="drawer-filter">
                <i class="fa-solid fa-filter"></i>&nbsp; Filter
            </button>
            <a href="{{ route('admin.post.create') }}" class="float-right hover:bg-blue-700 bg-blue-600 text-white font-bold py-2 px-4  rounded text-xs">
                <i class="fa-solid fa-plus"></i>&nbsp; Add Post
            </a>
        </div>
    </div>
    <div id="drawer-filter" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80" tabindex="-1" aria-labelledby="drawer-right-label">
        <div class="mt-16">
            <form action="{{ route('admin.post') }}" method="get">
                
                <div class="p-2 m-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg" value="{{ request('name') ? request('name') : '' }}" />
                </div>
                <div class="p-2 m-2">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg">
                        <option value="">Select Status</option>
                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="mb-4 p-4 text-left">
                    <button type="submit" class="text-white bg-blue-600 hover:bg-blue-500 font-bold py-2 px-4 rounded text-xs">Search</button>
                    <a href="{{ route('admin.post') }}" class="text-white bg-gray-500 hover:bg-gray-300 font-bold py-2 px-4 rounded text-xs ml-1 float-right">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="flex">
        <div class="flex-auto mt-8">
            <!-- <form action="{{ route('admin.post.delete') }}" method="post"> -->
                @csrf
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Slug
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($posts->count() > 0)
                            @foreach($posts as $post)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $post->name }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $post->slug }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $post->status == 1 ? 'Active' : 'Inactive' }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.post.delete') }}" method="post" class="inline-block" id="delete-form-{{ $post->id }}" >
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $post->id }}" />
                                            <button type="button" class="text-red-600 hover:text-red-900 deleteBtn" id="delete-form-id-{{ $post->id }}" >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="4" class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                    No Post found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            <!-- </form> -->
        </div>
    </div>
    <div class="flex">
        <div class="flex-auto mt-8">
            {{ $posts->links() }}
        </div>
    </div>
    <script>
        @if(Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }

            toastr.success("{{ session('success') }}");
        @endif
    </script>
    <script>
        let deleteBtn = document.querySelectorAll('.deleteBtn');
        deleteBtn.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let id = this.getAttribute('id');
                let formId = id.replace('delete-form-id-', '');
                let form = document.querySelector('#delete-form-' + formId);
                let confirmation = confirm('Are you sure you want to delete this post?');
                if(confirmation) {
                    form.submit();
                }
            });
        });
    </script>
@endsection