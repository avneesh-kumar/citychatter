@extends('layouts.guest')

@section('title', 'Privacy Policy')

@section('content')

    <section class="rounded-lg">
        <div class="mx-auto">
            <div class="">
                <div class="flex justify-center w-full text-center p-6 space-y-8 sm:p-8 bg-white">
                    <h2 class="text-2xl text-red-500 font-bold border-b-2 border-red-600">
                        Privacy Policy
                    </h2>
                </div>
                <div class="mx-4 lg:mx-72 text-justified">
                    <p>
                        {!! $privacyPolicy !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
                        