@extends('layouts.guest')

@section('content')

    <section class="rounded-lg">
        <div class="mx-auto">
            <div class="">
                <div class="flex justify-center w-full text-center p-6 space-y-8 sm:p-8 bg-white">
                    <h2 class="w-1/3 text-2xl text-red-500 font-bold border-b-2 border-red-600">
                        About Us
                    </h2>
                </div>
                <div class="text-justified">
                    <p>
                        {!! $aboutus !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
                        