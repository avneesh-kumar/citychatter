<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium mt-2 ">
            <li>
                <a href="{{ route('feed') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="ms-3">
                        Chatter
                    </span>
                </a>
            </li>
            
            @if(isset($slug) && $slug)
                @php $category = \Roilift\Admin\Models\Category::where('slug', $slug)->first(); @endphp
                @php $categories = \Roilift\Admin\Models\Category::where('status', 1)->where('parent_id', $category->id)->orderBy('sort_by', 'asc')->get(); @endphp
            @else 
                @php $categories = \Roilift\Admin\Models\Category::where('status', 1)->where('parent_id', NULL)->orderBy('sort_by', 'asc')->get(); @endphp
            @endif

            @if($categories->count() > 0)
                @if(isset($slug) && $slug)
                    @foreach($categories as $category)
                    <li class="pl-3" style="margin: 0;">
                        <a href="{{ route('feed', $category->slug) }}" class="flex items-center px-2 text-red-600 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="ms-3">
                                {{ $category->name }}
                            </span>
                        </a>
                    </li>
                    @endforeach
                @else
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('feed', $category->slug) }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="ms-3">
                                {{ $category->name }}
                            </span>
                        </a>
                    </li>
                    @endforeach
                @endif
            @endif
        </ul>
    </div>
</aside>