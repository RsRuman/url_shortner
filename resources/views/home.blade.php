@extends('layouts.app')

@section('title')
    Url Shortener | Home
@endsection

@section('content')
    <div class="container mx-auto">
        <h1 class="text-center text-blue-500 mt-4 font-semibold text-3xl">Short URL</h1>

        <div class="flex justify-center mt-6">
            <div class="relative flex flex-col text-gray-700 bg-white shadow-md bg-clip-border rounded-xl text-center">
                <div class="p-6">
                    <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                        Paste the URL to be shortened
                    </h5>

                    <form class="w-full max-w-sm" action="{{ route('shortener.store') }}" method="POST">
                        @csrf
                        <div class="flex items-center border-b border-teal-500 py-2">
                            <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text"
                                   placeholder="Enter the link here" aria-label="Full URL" name="url">
                            <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                                Shorten URL
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
