@extends('admin::layouts.app')

@section('content')

    <div class="flex">
        <div class="flex-1">
            <h1 class="text-gray-700 text-lg font-semibold pb-2 border-b border-gray-700">
                {{ $title }}
            </h1>
        </div>
        <div class="flex-1 items-end text-right">
            <!-- <button type="button"  class="float-right hover:bg-red-700 bg-red-600 text-white font-bold py-2 px-4 rounded text-xs ml-2" data-drawer-target="drawer-filter" data-drawer-show="drawer-filter" data-drawer-placement="right" aria-controls="drawer-filter">
                <i class="fa-solid fa-filter"></i>&nbsp; Filter
            </button> -->
            <!-- <a href="{{ route('admin.post.create') }}" class="float-right hover:bg-red-700 bg-red-600 text-white font-bold py-2 px-4  rounded text-xs">
                <i class="fa-solid fa-plus"></i>&nbsp; Add Post
            </a> -->
        </div>
    </div>
    <!-- <div id="drawer-filter" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80" tabindex="-1" aria-labelledby="drawer-right-label">
        <div class="mt-16">
            <form action="{{ route('admin.post') }}" method="get">
                
                <div class="p-2 m-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring-red-600 w-full p-2 rounded-lg" value="{{ request('title') ? request('title') : '' }}" />
                </div>
                <div class="p-2 m-2">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-600 w-full p-2 rounded-lg">
                        <option value="" selected>Select Status</option>
                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="mb-4 p-4 text-left">
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-500 font-bold py-2 px-4 rounded text-xs">Search</button>
                    <a href="{{ route('admin.post') }}" class="text-white bg-gray-500 hover:bg-gray-300 font-bold py-2 px-4 rounded text-xs ml-1 float-right">Reset</a>
                </div>
            </form>
        </div>
    </div> -->

    <div class="flex">
        <div class="flex-auto mt-8">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Reason
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Reported By
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
                    @if($reportedPosts->count() > 0)
                        @foreach($reportedPosts as $reportedPost)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $reportedPost->post->title }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    <div id="tooltip-description-{{ $reportedPost->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-red-500 transition-opacity duration-300 rounded-lg shadow-sm opacity-0 tooltip border border-red-500 ">
                                        {{ $reportedPost->description }}
                                        <div class="tooltip-arrow" class="border bg-red-500" data-popper-arrow></div>
                                    </div>
                                    <span data-tooltip-target="tooltip-description-{{ $reportedPost->id }}">
                                        {{ $reportedPost->reason }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $reportedPost->reporter->name }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $reportedPost->post->status == 1 ? 'Active' : 'Inactive' }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    @if($reportedPost->post->status)
                                        <button type="button" title="Disapprove post" class="text-red-600 hover:text-red-900 disapprove-btn" data-id="{{ $reportedPost->post->id }}">
                                            <i class="fa-solid fa-thumbs-down"></i>
                                        </button>
                                    @else
                                        <button type="button" title="Approve post" class="text-green-600 hover:text-green-900 approve-btn" data-id="{{ $reportedPost->post->id }}">
                                            <i class="fa-solid fa-thumbs-up"></i>
                                        </button>
                                    @endif
                                    <a href="{{ route('post', $reportedPost->post->slug) }}" target="_blank" class="text-red-600 hover:text-red-900">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="4" class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                No Reported Post found.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="flex">
        <div class="flex-auto mt-8">
            {{ $reportedPosts->links() }}
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('.approve-btn').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let confirmation = confirm('Are you sure you want to activate this post?');
                if(confirmation) {
                    $.ajax({
                        url: "{{ route('admin.post.activate') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if(response.success) {
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.success(response.message, 'Success');
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.error(response.message, 'Error');
                            }
                        }
                    });
                }
            });

            $('.disapprove-btn').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let confirmation = confirm('Are you sure you want to deactivate this post?');
                if(confirmation) {
                    $.ajax({
                        url: "{{ route('admin.post.deactivate') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if(response.success) {
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.success(response.message, 'Success');
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.error(response.message, 'Error');
                            }
                        }
                    });
                }
            });
        });

    </script>
@endsection