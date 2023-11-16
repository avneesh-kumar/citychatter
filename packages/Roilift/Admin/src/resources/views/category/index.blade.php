@extends('admin::layouts.app')

@section('content')
    <div class="flex">
        <div class="flex-1">
            <h1 class="text-gray-700 text-lg font-semibold pb-2 border-b border-gray-700">
                Category
            </h1>
        </div>
        <div class="flex-1 items-end text-right">
            <button type="button"  class="float-right hover:bg-blue-700 bg-blue-600 text-white font-bold py-2 px-4 rounded text-xs ml-2" data-drawer-target="drawer-filter" data-drawer-show="drawer-filter" data-drawer-placement="right" aria-controls="drawer-filter">
                <i class="fa-solid fa-filter"></i>&nbsp; Filter
            </button>
            <a href="{{ route('admin.category.create') }}" class="float-right hover:bg-blue-700 bg-blue-600 text-white font-bold py-2 px-4  rounded text-xs">
                <i class="fa-solid fa-plus"></i>&nbsp; Add Category
            </a>
        </div>
    </div>
    <div id="drawer-filter" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80" tabindex="-1" aria-labelledby="drawer-right-label">
        <div class="mt-16">
            <form action="{{ route('admin.category') }}" method="get">
                
                <div class="p-2 m-2">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg" value="{{ request('email') ? request('email') : '' }}" />
                </div>
                <div class="mb-4 p-4 text-left">
                    <button type="submit" class="text-white bg-blue-600 hover:bg-blue-500 font-bold py-2 px-4 rounded text-xs">Search</button>
                    <a href="{{ route('admin.category') }}" class="text-white bg-gray-500 hover:bg-gray-300 font-bold py-2 px-4 rounded text-xs ml-1 float-right">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="flex">
        <div class="flex-auto mt-8">
            <!-- <form action="" method="post"> -->
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
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories->count() > 0)
                            @foreach($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $category->slug }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.category.delete') }}" method="post" class="inline-block">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $category->id }}" />
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="3" class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                    No Category found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            <!-- </form> -->
        </div>
    </div>
@endsection