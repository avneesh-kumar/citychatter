@extends('layouts.guest')

@section('content')
    <section class="rounded-lg">
        <div class="mx-auto">
            <div class="flex  justify-center">
                <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white  dark:bg-gray-800">
                    <h2 class="text-center text-2xl text-red-500 font-bold border-b-2 border-red-600">
                        @if($valid)
                            Email Verified 
                            <br />
                            <a href="{{ route('login') }}" class="text-red-500">Click here to login</a>
                        @else
                            Invalid Token, please try again
                        @endif
                    </h2>
                </div>
            </div>
        </div>
    </section>

@endsection