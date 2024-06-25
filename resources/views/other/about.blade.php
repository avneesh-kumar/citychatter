@extends('layouts.guest')

@section('content')

    <section class="rounded-lg">
        <div class="mx-auto">
            <div class="relative w-full">
                <div class="flex justify-center w-full text-center p-6 space-y-8 sm:p-8">
                    <h2 class="text-2xl text-red-500 font-bold border-b-2 border-red-600">
                        About Us
                    </h2>
                </div>
                <div class="mx-4 lg:mx-72 text-justified">
                    <p>
                        {!! $aboutus !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
                        