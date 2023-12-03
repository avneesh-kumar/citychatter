<header class="flex w-screen p-4 bg-blue-500">
    <div class="flex-2 text-left mx-4 self-center" id="logo">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </div>
    <div id="searchbox" class="flex-1 self-center w-8 mx-4">
        <form>
            <div class="flex">
                <label
                    for="search-dropdown"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only"
                    >Your Email</label
                >
                <button
                    id="dropdown-button"
                    data-dropdown-toggle="dropdown"
                    class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-1 focus:outline-none focus:ring-gray-100"
                    type="button"
                >
                    All categories
                    <svg
                        class="w-2.5 h-2.5 ms-2.5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 10 6"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 4 4 4-4"
                        />
                    </svg>
                </button>
                <div
                    id="dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
                >
                    <ul
                        class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdown-button"
                    >
                        <li>
                            <button
                                type="button"
                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100 hover:text-gray-900"
                            >
                                Mockups
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="relative w-full">
                    <input
                        type="search"
                        id="search-dropdown"
                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="Search Mockups, Logos, Design Templates..."
                        required
                    />
                    <button
                        type="submit"
                        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        <svg
                            class="w-4 h-4"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 20 20"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                            />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div id="userprofile" class="flex-2 self-center">
        @if(auth()->user())
        <button
            id="dropdownAvatarNameButton"
            data-dropdown-toggle="dropdownAvatarName"
            class="flex items-center text-sm pe-1 font-medium rounded-full text-white"
            type="button"
        >
            <span class="sr-only">Open user menu</span>
            <img
                class="w-8 h-8 me-2 rounded-full"
                src="https://img.freepik.com/free-psd/3d-icon-social-media-app_23-2150049569.jpg?w=826&t=st=1700646757~exp=1700647357~hmac=59303d19606756fc0fcf62a345e6d895019e043bee33aeb20706751698d3c6ca"
                alt="user photo"
            />
            Bonnie Green
            <svg
                class="w-2.5 h-2.5 ms-3"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 10 6"
            >
                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 4 4 4-4"
                />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div
            id="dropdownAvatarName"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
        >
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                <div class="font-medium">Pro User</div>
                <div class="truncate">name@flowbite.com</div>
            </div>
            <ul
                class="py-2 text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton"
            >
                <li>
                    <a
                        href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        >Dashboard</a
                    >
                </li>
                <li>
                    <a
                        href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        >Settings</a
                    >
                </li>
                <li>
                    <a
                        href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        >Earnings</a
                    >
                </li>
            </ul>
            <div class="py-2">
                <a
                    href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                    >Sign out</a
                >
            </div>
        </div>
        @else
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button
                    type="button"
                    class="px-4 py-2 text-sm font-semibold bg-blue-500 text-white border border-white rounded-s-lg "
                >
                    Login
                </button>
                <button
                    type="button"
                    class="px-4 py-2 text-sm font-semibold bg-blue-500 text-white border border-white rounded-e-lg "
                >
                    Signup
                </button>
            </div>
        @endif
    </div>
</header>
