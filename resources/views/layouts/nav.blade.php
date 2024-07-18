<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 ">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <!-- logo section and mobile menu button -->
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 ">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="{{ route('home') }}" class="flex ms-2 md:me-24">
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-red-500">CityChatter</span>
                </a>
            </div>
            <!-- end here -->

            <!-- search bar -->
            <div class="hidden lg:flex items-center justify-center rtl:justify-end w-full">
                <div class="relative mt-0 w-full ">
                    <form method="get" action="{{ route('search') }}" id="search-form" class="flex items-center justify-left" style="padding-left: 4.5rem;">
                        <input type="text" id="search" name="search" class="inline-block w-[43%] mr-2 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 " placeholder="Search citychatter" value="{{ request('search') }}">
                        <input type="text" id="area" name="location" class="inline-block mr-2 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 " placeholder="My City/Zip" value="{{ request('location') }}">
                        <input type="text" id="radius" name="radius" class="inline-block w-20 mr-2 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 " placeholder="In miles" value="{{ request('radius') }}">
                        <input type="hidden" id="s_latitude" name="s_latitude" value="{{ request('latitude') }}">
                        <input type="hidden" id="s_longitude" name="s_longitude" value="{{ request('longitude') }}">
                        <button type="button" id="searchBtn" class="py-1 px-2 text-white bg-red-500 border border-transparent rounded-md shadow-sm hover:bg-red-600 focus:outline-none" title="Search">
                            Search
                        </button>
                    </form>
                </div>
            </div>
            <!-- end here -->

            <!-- right side menu bar -->
            <div class="flex items-center">
                <button type="button" data-modal-target="search-modal" data-modal-toggle="search-modal" class="lg:hidden mr-2 p-1.5 text-center font-medium text-white bg-red-500 border border-transparent rounded-md shadow-sm hover:bg-red-600 focus:outline-none">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
                
                @if(Auth::check())
                    <a href="{{ route('post.create') }}" class="hidden lg:block text-2xl mr-2 px-2 text-center font-medium text-white bg-red-500 border border-transparent rounded-md shadow-sm hover:bg-red-600 focus:outline-none" title="Add Post">
                        &#x2b;
                    </a>
                @endif

                @if(Auth::check())
                    <div class="flex items-center w-8 ms-3">
                        <div>
                            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 " aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                @if(auth()->user()->profile->avatar)
                                    <img src="{{ asset(auth()->user()->profile->avatar) }}" alt="{{ auth()->user()->name }}" class="h-8 w-8 shadow-xl rounded-full object-cover">
                                @else
                                    <img src="{{ asset('images/avatar.jpg') }}" alt="{{ auth()->user()->name }}" class="h-8 w-8 shadow-xl rounded-full object-cover">
                                @endif
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow " id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 " role="none">
                                    @if(Auth::check())
                                        <a href="{{ route('user.profile', auth()->user()->profile->username) }}">
                                            {{ Auth::user()->name }}
                                        </a>
                                    @endif
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('message') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white" role="menuitem">Messages</a>
                                </li>
                                <li>
                                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white" role="menuitem">Profile Settings</a>
                                </li>
                                <li>
                                    <a href="{{ route('account.reset-password') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white" role="menuitem">Reset Password</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-red-500 hover:text-white" role="menuitem">Sign out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="p-2 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm  " >Login </a>

                    <a href="{{ route('register') }}" class="ml-2 p-2 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm  " >Signup </a>
                @endif
            </div>
            <!-- end here -->
        </div>
    </div>
</nav>

@if(Auth::check())
    <div class="fixed block lg:hidden bottom-6 z-10 left-1/2 transform -translate-x-1/2 mb-4">
        <a href="{{ route('post.create') }}" title="Add Post" class="bg-red-500 text-white text-4xl px-4 py-2 rounded-full shadow-lg hover:bg-red-600">
            &#x2b;
        </a>
    </div>
@endif

<!-- Main modal -->
<div id="search-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                <h3 class="text-lg font-semibold text-gray-900">
                    Search
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="search-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="relative mt-0 w-full ">
                    <form method="get" action="{{ route('search') }}" id="modal-search-form" class="items-center justify-center">
                        <div class="mb-4">
                            <input type="text" id="modal_search" name="search" class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 " placeholder="Search citychatter" value="{{ request('search') }}">
                        </div>
                        <div class="mb-4">
                            <div class="flex w-full">
                                <div class="w-1/2">
                                <input type="text" id="modal_area" name="location" class="p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 " placeholder="My City/Zip" value="{{ request('location') }}">
                                </div>
                                <div class="w-1/2">
                                    <input type="text" id="modal_radius" name="radius" class="w-20 mr-2 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 " placeholder="In miles" value="{{ request('radius') }}">
                                    <input type="hidden" id="modal_s_latitude" name="s_latitude" value="{{ request('latitude') }}">
                                    <input type="hidden" id="modal_s_longitude" name="s_longitude" value="{{ request('longitude') }}">
                                    <button type="button" id="modal_searchBtn" class="float-right py-1 px-2 text-white bg-red-500 border border-transparent rounded-md shadow-sm hover:bg-red-600 focus:outline-none" title="Search">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

    
<script>
    $('document').ready(function() {
        var location = localStorage.getItem('location');
        $('#area').val(location);
        $('#modal_area').val(location);
        var latitude = localStorage.getItem('latitude');
        if(latitude) {
            $('#s_latitude').val(latitude);
            $('#modal_s_latitude').val(latitude);
        }
        var longitude = localStorage.getItem('longitude');
        if(longitude) {
            $('#s_longitude').val(longitude);
            $('#modal_s_longitude').val(longitude);
        }
        var radius = localStorage.getItem('radius');
        $('#radius').val(radius);
        $('#modal_radius').val(radius);

        var input = document.getElementById('area');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            $('#s_latitude').val(place.geometry.location.lat());
            $('#s_longitude').val(place.geometry.location.lng());
            $('#modal_s_latitude').val(place.geometry.location.lat());
            $('#modal_s_longitude').val(place.geometry.location.lng());

            localStorage.setItem('location', place.formatted_address);
            localStorage.setItem('latitude', place.geometry.location.lat());
            localStorage.setItem('longitude', place.geometry.location.lng());
        });

        var modal_input = document.getElementById('modal_area');
        var modal_autocomplete = new google.maps.places.Autocomplete(modal_input);
        modal_autocomplete.addListener('place_changed', function() {
            var place = modal_autocomplete.getPlace();
            $('#s_latitude').val(place.geometry.location.lat());
            $('#s_longitude').val(place.geometry.location.lng());
            $('#modal_s_latitude').val(place.geometry.location.lat());
            $('#modal_s_longitude').val(place.geometry.location.lng());

            localStorage.setItem('location', place.formatted_address);
            localStorage.setItem('latitude', place.geometry.location.lat());
            localStorage.setItem('longitude', place.geometry.location.lng());
        });

        $('#radius, #modal_radius').on('change', function() {
            localStorage.setItem('radius', $(this).val());
        });

    });
</script>

<script>

    $('#searchBtn').on('click', function() {
        let keyword = $('#area').val();
        if(keyword == '') {
            $('#s_latitude').val('');
            $('#s_longitude').val('');
        }
        $('#search-form').submit();
    });

    $('#modal_searchBtn').on('click', function() {
        let keyword = $('#modal_area').val();
        if(keyword == '') {
            $('#modal_s_latitude').val('');
            $('#modal_s_longitude').val('');
        }
        $('#modal-search-form').submit();
    });

    document.getElementById('search').addEventListener('keypress', function(e) {
        let keyword = $('#area').val();
        if (e.key === 'Enter') {
            e.preventDefault();
            if(keyword == '') {
                $('#s_latitude').val('');
                $('#s_longitude').val('');
            }
            $('#search-form').submit();
        }
    });

    document.getElementById('modal_search').addEventListener('keypress', function(e) {
        let keyword = $('#modal_area').val();
        if (e.key === 'Enter') {
            e.preventDefault();
            if(keyword == '') {
                $('#modal_s_latitude').val('');
                $('#modal_s_longitude').val('');
            }
            $('#modal-search-form').submit();
        }
    });
    
</script>