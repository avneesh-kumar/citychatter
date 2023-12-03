@extends('layouts.guest')

@section('content')
<div class="text-center w-full">
    <h1 class="text-5xl text-blue-500 p-4 m-4">
        CityChatter
    </h1>
    <p class="text-xl">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis molestias magni ipsa mollitia aliquam ipsam quasi at earum non quod atque perferendis sunt sequi dicta blanditiis, in odio voluptatem aut.
    </p>
</div>

<div class="w-full mt-8">
    <div class="flex  justify-center">
        <div class="md:w-1/2">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="flex-1 me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Login</button>
                    </li>
                    <li class="flex-1 me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Signup</button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <section class="bg-gray-50 dark:bg-gray-900">
                        <div class="py-8 px-4 mx-auto">
                            <div class="flex justify-center">
                                <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        Sign in
                                    </h2>
                                    <form class="mt-8 space-y-6" action="#">
                                        <div>
                                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required>
                                        </div>
                                        <div>
                                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required>
                                            </div>
                                            <div class="ms-3 text-sm">
                                                <label for="remember" class="font-medium text-gray-500 dark:text-gray-400">Remember this device</label>
                                            </div>
                                            <a href="#" class="ms-auto text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Lost Password?</a>
                                        </div>
                                        <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            Not registered yet? <a class="text-blue-600 hover:underline dark:text-blue-500">Create account</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <section class="bg-gray-50 dark:bg-gray-900">
                        <div class="py-8 px-4 mx-auto">
                            <div class="flex justify-center">
                                <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        Register
                                    </h2>
                                    <form class="mt-8 space-y-6" action="#">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your name" required>
                                        </div>
                                        <div>
                                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your email id" required>
                                        </div>
                                        <div>
                                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                                            <input type="password" name="password" id="password" placeholder="Enter password for your account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required>
                                            </div>
                                            <div class="ms-3 text-sm">
                                                <label for="remember" class="font-medium text-gray-500 dark:text-gray-400">Remember this device</label>
                                            </div>
                                            <a href="#" class="ms-auto text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Lost Password?</a>
                                        </div>
                                        <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            Not registered yet? <a class="text-blue-600 hover:underline dark:text-blue-500">Create account</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection