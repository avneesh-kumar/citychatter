<footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between mb-4">
            <a href="{{ route('home') }}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-red-500">CityChatter</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="{{ route('about') }}" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="{{ route('mission') }}" class="hover:underline me-4 md:me-6">Mission</a>
                </li>
                <li>
                    <a href="{{ route('privacy-policy') }}" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="{{ route('terms') }}" class="hover:underline me-4 md:me-6">Terms</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">CityChatter</a>. All Rights Reserved.</span>
        <br />
        <div class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
            Curated by <a href="https://roilift.com/" class="hover:underline">Roilift</a>
        </div>
    </div>

    <script>
        // $('document').ready(function() {
        //     @if (!session('latitude') && !session('longitude'))
        //         if(navigator.geolocation) {
        //             navigator.geolocation.getCurrentPosition(function(position) {
        //                 const latitude = position.coords.latitude;
        //                 const longitude = position.coords.longitude;
        //                 $.ajax({
        //                     url: "{{ route('currentlocation') }}",
        //                     type: "POST",
        //                     data: {
        //                         latitude: latitude,
        //                         longitude: longitude,
        //                         _token: "{{ csrf_token() }}"
        //                     },
        //                     success: function(response) {
        //                         console.log(response);
        //                     }
        //                 });
        //             });
        //         }
        //     @endif
        // });
    </script>
</footer>