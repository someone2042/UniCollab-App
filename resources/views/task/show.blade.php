<!DOCTYPE html>
<html lang="en">

<head>
    {{-- @php
    dd($mainGroup);
@endphp --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    {{-- <link href="./output.css" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>UniColab</title>
    <style>
        .hide {
            display: none;
        }

        .scrolling {
            overflow-y: auto;
        }

        .h-calc-screen {
            height: calc(100vh - 64px);
            /* Subtracting 100px for the header */
        }

        .h-calc-screen2 {
            height: calc(100vh - 128px);
            /* Subtracting 100px for the header */
        }

        .right1 {
            right: 0;
            top: 64px;
            border-left: solid 1px #B6B6B6;
            position: absolute;
            align-items: normal;
            flex-direction: column;
            display: flex;
        }

        .gpt {
            background-color: #212121;
        }

        .items-start {
            align-items: flex-start;
        }

        .pt-3 {
            padding-top: 0.75rem;
            box-shadow: -2px -2px 17px -1px rgba(0, 0, 0, 0.41);
        }

        .container1 {
            display: flex;
            padding: 0%;
            height: calc(100vh - 64px);
            overflow: hidden;
        }

        .center {
            flex-grow: 1;
            /* Allow center div to grow and fill remaining space */
            position: absolute;
            left: 288px;
            right: 288px;
            /* min-width: 420px; */
            overflow-x: visible
        }


        @media (max-width: 1023px) {
            .center {
                left: 0px;
                right: 288px;
            }
        }

        @media (max-width: 768px) {
            .center {
                left: 0px;
                right: 48px;
            }
        }

        .header1 {
            background-color: #ffffff;
            /* Adjust header background color */
            color: #1967D2;
            /* Adjust header text color */
            display: flex;
            /* Activate flexbox for header alignment */
            align-items: center;
            /* Align header content vertically */
            justify-content: center;
            /* Align header content horizontally */
        }

        .w-1\/4 {
            width: 25%;
            text-align: center;
            font-family: 'mon';
            font-weight: 200;
        }

        .border-blue1 {
            border-color: #1967D2;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .overflow-scroll {
            overflow: scroll;
        }

        .overflow-auto {
            overflow: auto;
        }

        .hoverstyle:hover {
            background-color: rgb(232, 240, 254);
            /* cursor: pointer; */
        }

        .backimage {
            /* background: url({{ asset('img/bg.png') }}); */
            opacity: 0.3;
            background-size: cover;
            position: absolute;
            /* Make the background div absolute */
            top: 0;
            left: 0;
            width: 100%;
            /* Set width and height to cover the container div */
            height: 100%;
            z-index: -1;
            /* Place the background behind the content */
        }

        .title-text {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* number of lines to show */
            line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .title-text-sm {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* number of lines to show */
            line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .h-fittall {
            height: -webkit-fill-available;
        }
    </style>
</head>

<body class="background h-screen bg-back">
    <x-flash-message />
    <header class="sticky left-0 top-0 z-50 h-16 w-full bg-header text-black1">
        <div class=""
            style="display: flex; left: 0; position: absolute; right: 0; justify-content: space-around;">
            <a href="/home">
                <div class="pointer flex h-16 flex-shrink-0 items-center" style="position: absolute; left: 0;">
                    <img class="h-12 w-12" src="{{ asset('img/logo.png') }}" alt="Logo">
                    <p class="mx-5 font-mon text-2xl font-bold">UniCollab</p>
                </div>
            </a>
            <ul class="m-4 flex space-x-4 pr-5" style=" position: absolute; right: 0; margin: 16px;">
                <a href="/profile">
                    <li>
                        @if (auth()->user()->profile_url != null)
                            <img src="{{ asset('/storage/' . auth()->user()->profile_url) }}"
                                class="size-10 rounded-full">
                        @else
                            <a class="size-10 rounded-full" href="/profile">
                                <svg class="text-black1-500 pointer h-9 w-9" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </a>
                        @endif
                    </li>
                </a>
                <li class="mt-1">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit">
                            <svg class="text-black1-500 pointer h-9 w-9" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 12h14l-3 -3m0 6l3 -3" />
                            </svg>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </header>
    {{-- @php
        dd($groups,$members);
    @endphp --}}
    <style>
        .parent-div {
            display: flex;
            /* Use flexbox for horizontal arrangement */
            flex-wrap: wrap;
            /* Wrap child divs to the next line if they overflow */
            width: 100%;
            /* Set width to 100% to take up the full container */
            margin: 0 auto;
            /* Optionally center the parent div horizontally */
            justify-content: space-evenly;
        }

        .child-div {
            width: 150px;
            /* Set a fixed width for each child div */
            height: 200px;
            /* Set a fixed height for each child div (optional) */
            margin: 1px;
            /* Add optional margins between child divs */
            /* background-color: #717171; */
            /* Optional background color for visual distinction */
            /* background-image: url('/file.png'); */
        }

        .file {
            height: 175px;
            width: 100%;
            /* background-image: url('/file.png'); */
        }
    </style>
    <div class="container1">
        <div class="h-calc-screen border-gray2-500 items-normal hidden w-72 flex-col border-r bg-white lg:flex">
            <div class="flex h-16 items-center border-b border-gray2 py-3">
                <i class="px-5">
                    <svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="60px" height="50px"
                        viewBox="924 565.952 200 200" enable-background="new 924 565.952 200 200" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M984.585,626.893c0,14-9.609,25.348-21.461,25.348s-21.459-11.348-21.459-25.348c0-13.999,9.607-25.345,21.459-25.345
                            S984.585,612.895,984.585,626.893z" />
                                <path
                                    d="M987.586,671.591c1.549-0.945,3.265-1.56,5.041-1.854c-3.606-5.088-6.161-10.546-7.637-17.078
                            c-0.404-2.387-3.672-2.667-6.102-0.687c-4.545,3.706-9.849,6.186-15.764,6.186c-6.03,0-11.577-2.399-16.025-6.414
                            c-1.419-1.283-3.51-1.476-5.142-0.479c-8.444,5.157-14.835,13.344-17.623,23.064c-0.748,2.607-0.223,5.421,1.411,7.59
                            c1.637,2.166,4.192,3.443,6.906,3.443h38.669C975.947,680.023,981.41,675.362,987.586,671.591z" />
                            </g>
                            <g>
                                <path d="M1063.414,626.893c0,14,9.61,25.348,21.462,25.348s21.46-11.348,21.46-25.348c0-13.999-9.608-25.345-21.46-25.345
                            S1063.414,612.895,1063.414,626.893z" />
                                <path
                                    d="M1060.413,671.591c-1.549-0.945-3.264-1.56-5.04-1.854c3.605-5.088,6.16-10.546,7.637-17.078
                            c0.404-2.387,3.674-2.667,6.103-0.687c4.545,3.706,9.849,6.186,15.764,6.186c6.03,0,11.576-2.399,16.024-6.414
                            c1.42-1.283,3.51-1.476,5.143-0.479c8.443,5.157,14.834,13.344,17.623,23.064c0.748,2.608,0.222,5.421-1.412,7.59
                            c-1.635,2.166-4.192,3.443-6.906,3.443h-38.668C1072.052,680.023,1066.59,675.362,1060.413,671.591z" />
                            </g>
                            <g>
                                <path d="M1082.474,713.402c-4.198-14.654-13.72-27.044-26.327-34.991c-2.487-1.567-5.715-1.313-7.921,0.631
                            c-6.765,5.958-15.136,9.506-24.226,9.506c-9.268,0-17.791-3.686-24.626-9.856c-2.181-1.97-5.393-2.267-7.901-0.734
                            c-12.977,7.925-22.8,20.505-27.082,35.445c-1.151,4.008-0.344,8.329,2.166,11.663c2.516,3.329,6.443,5.29,10.615,5.29h92.521
                            c4.173,0,8.103-1.954,10.618-5.29C1082.822,721.731,1083.625,717.414,1082.474,713.402z" />
                                <path d="M1056.98,640.499c0,21.512-14.767,38.955-32.98,38.955s-32.979-17.442-32.979-38.955
                            c0-21.515,14.765-38.951,32.979-38.951S1056.98,618.984,1056.98,640.499z" />
                            </g>
                        </g>
                    </svg>
                </i>
                <p class="font-mon text-2xl font-semibold">
                    Groups
                </p>
            </div>
            <div class="flex w-full border-b shadow">
                <div class="relative text-gray-600">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <button type="submit" class="focus:shadow-outline p-1 focus:outline-none">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" class="h-6 w-6">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </span>
                    <input type="text" name="q"
                        class="h-10 w-72 rounded-md py-2 pl-10 text-sm text-white focus:bg-white focus:text-gray-900 focus:outline-none"
                        placeholder="Search..." autocomplete="off" id="group_search">
                </div>
            </div>
            <div class="scrolling h-fittall">
                <!-- Projects Listing goes here -->
                @foreach ($groups as $group)
                    @if ($group->id == $mainGroup->id)
                        <div class="flex h-20 w-full items-center border-b border-r-4 border-blue2 border-r-blue1 bg-blue2 pl-2"
                            id="{{ $group->id }}">
                        @else
                            <div class="hoverstyle flex h-20 w-full items-center border-b border-blue2 pl-2"
                                id="{{ $group->id }}">
                    @endif
                    <div class="grid px-2">
                        <a href="/group/{{ $group->id }}"><span
                                class="title-text font-mon font-medium">{{ $group->title }} </span></a>
                        <span class="title-text-sm font-mon text-xs font-medium text-gray1">{{ $group->company }}
                        </span>
                    </div>

            </div>
            @endforeach
            <!-- Projects Listing goes here -->
        </div>
    </div>
    <div class="center">
        <div class="header1 h-16 overflow-hidden">
            <div class="hoverstyle grid h-full w-1/4 items-center">
                <a href="/group/{{ $mainGroup->id }}/chat">
                    <p class="hidden border-r border-blue1 font-mon text-xl font-semibold sm:block">Chat</p>

                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" class="m-auto sm:hidden"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22 6.25V11.35C22 12.62 21.58 13.69 20.83 14.43C20.09 15.18 19.02 15.6 17.75 15.6V17.41C17.75 18.09 16.99 18.5 16.43 18.12L15.46 17.48C15.55 17.17 15.59 16.83 15.59 16.47V12.4C15.59 10.36 14.23 9 12.19 9H5.39999C5.25999 9 5.13 9.01002 5 9.02002V6.25C5 3.7 6.7 2 9.25 2H17.75C20.3 2 22 3.7 22 6.25Z"
                            stroke="#1967D2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M15.59 12.4V16.47C15.59 16.83 15.55 17.17 15.46 17.48C15.09 18.95 13.87 19.87 12.19 19.87H9.47L6.45 21.88C6 22.19 5.39999 21.86 5.39999 21.32V19.87C4.37999 19.87 3.53 19.53 2.94 18.94C2.34 18.34 2 17.49 2 16.47V12.4C2 10.5 3.18 9.19002 5 9.02002C5.13 9.01002 5.25999 9 5.39999 9H12.19C14.23 9 15.59 10.36 15.59 12.4Z"
                            stroke="#1967D2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <div class="hoverstyle grid h-full w-1/4 items-center border-b-4 border-blue1">
                <a href="/group/{{ $mainGroup->id }}/task" class="relative">
                    <p class="hidden border-r border-blue1 font-mon text-xl font-semibold sm:block">Tasks</p>

                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" class="m-auto sm:hidden"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.37 8.87988H17.62" stroke="#1967D2" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6.38 8.87988L7.13 9.62988L9.38 7.37988" stroke="#1967D2" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.37 15.8799H17.62" stroke="#1967D2" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6.38 15.8799L7.13 16.6299L9.38 14.3799" stroke="#1967D2" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                            stroke="#1967D2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    @if ($taskcount != 0)
                        <span
                            class="absolute bottom-3 right-10 h-4 w-4 rounded-full bg-red-600 text-center font-mon text-xs font-semibold text-white">{{ $taskcount }}</span>
                    @endif
                </a>
            </div>
            <div class="hoverstyle grid h-full w-1/4 items-center">
                <a href="/group/{{ $mainGroup->id }}/documents">
                    <p class="hidden border-r border-blue1 font-mon text-xl font-semibold sm:block">Documents</p>

                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" class="m-auto sm:hidden"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.4299 14.55H9.42993" stroke="#1967D2" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M22 11V17C22 21 21 22 17 22H7C3 22 2 21 2 17V7C2 3 3 2 7 2H8.5C10 2 10.33 2.44 10.9 3.2L12.4 5.2C12.78 5.7 13 6 14 6H17C21 6 22 7 22 11Z"
                            stroke="#1967D2" stroke-width="1.5" stroke-miterlimit="10" />
                    </svg>
                </a>
            </div>
            <div class="hoverstyle grid h-full w-1/4 items-center">
                <a href="/group/{{ $mainGroup->id }}/projects">
                    <p class="hidden font-mon text-xl font-semibold sm:block">Project</p>


                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" class="m-auto sm:hidden"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.5 10.6499H9.5" stroke="#1967D2" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 8.20996V13.21" stroke="#1967D2" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M16.8199 2H7.17995C5.04995 2 3.31995 3.74 3.31995 5.86V19.95C3.31995 21.75 4.60995 22.51 6.18995 21.64L11.0699 18.93C11.5899 18.64 12.4299 18.64 12.9399 18.93L17.8199 21.64C19.3999 22.52 20.6899 21.76 20.6899 19.95V5.86C20.6799 3.74 18.9499 2 16.8199 2Z"
                            stroke="#1967D2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
        <div id="content1" class="content1 h-calc-screen2 overflow-auto">
            {{-- <div class="w-full h-full bg-white opacity-65 absolute"></div> --}}
            <div id="myDiv" class="backimage h-full w-full bg-center">
            </div>

            <div class="h-full content-start overflow-auto">
                <div class="">
                    <div class="mx-4 mb-4 mt-4 rounded border border-gray-200 bg-gray-50 p-6 shadow-md">
                        <header class="mb-4 text-start">

                            <h2 class="mb-1 flex justify-between font-mon text-xl">
                                {{ $task->title }}
                                @if ($task->status == 'assigned')
                                    <p class="text-lg text-blue-800">Assigned</p>
                                @endif
                                @if ($task->status == 'submitted')
                                    <p class="text-lg text-yellow-500">Submitted</p>
                                @endif
                                @if ($task->status == 'accepted')
                                    <p class="text-lg text-green-700">Accepted</p>
                                @endif
                                @if ($task->status == 'rejected')
                                    <p class="text-lg text-red-600">Rejected</p>
                                @endif
                            </h2>
                            <p>{{ $task->description }}</p>
                            @php
                                $date = $task->deadline;
                                // dd($date,$task->created_at);
                                $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date);
                                $day = $date->format('d'); // Day of the month (01-31)
                                $month = $date->format('M');
                                $houre = $date->format('G');
                                $minute = $date->format('i');
                                // dd($time);
                            @endphp
                            <p class="my-4 text-sm text-yellow-600 underline">Deadline:
                                {{ $day . ' ' . $month . ' at ' . $houre . ':' . $minute }}</p>
                        </header>

                        @if ($task->status == 'assigned')
                            <form action="/group/{{ $mainGroup->id }}/task/{{ $task->id }}"
                                class="rounded-sm bg-gray-100 p-6" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-6">
                                    <label for="response_title" class="mb-2 inline-block">Response title</label>
                                    <input type="text" class="w-full rounded border border-gray-200 p-2"
                                        name="response_title" placeholder="response_title"
                                        value="{{ old('response_title') }}" />
                                    @error('response_title')
                                        <p class="test-xs mt-1 text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="response_description" class="mb-2 inline-block">Response description
                                    </label>
                                    <textarea name="response_description" id="response_description"
                                        class="h-52 w-full rounded border border-gray-200 p-2" placeholder="response_description">{{ old('response_description') }}</textarea>
                                    @error('response_description')
                                        <p class="test-xs mt-1 text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label for="response_files" class="mb-2 inline-block">response files </label>
                                    <input type="file" name="response_files[]"
                                        class="w-full rounded border border-gray-200 p-2" id="response_files"
                                        multiple>
                                    @error('response_files')
                                        <p class="test-xs mt-1 text-red-500">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mb-6">
                                    <button class="hover:bg-laravel2 rounded bg-blue1 px-4 py-2 text-lg text-white">
                                        Submit Task
                                    </button>

                                    <a href="/group/{{ $mainGroup->id }}/task" class="ml-4 text-black">
                                        Back
                                    </a>
                                </div>
                            </form>
                        @else
                            <h2 class="mb-1 font-mon text-xl">submitted response:</h2>
                            <p class="mb-1 text-lg">{{ $task->response_title }}</p>
                            <p>{{ $task->response_description }}</p>
                            @php
                                $date = $task->response_date;
                                // dd($date,$task->created_at);
                                $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date);
                                $day = $date->format('d'); // Day of the month (01-31)
                                $month = $date->format('M');
                                $houre = $date->format('G');
                                $minute = $date->format('i');
                                // dd($time);
                            @endphp
                            <p class="mt-3 underline">submitted files:</p>
                            <ul class="ml-5 w-full list-disc pr-8">
                                @foreach ($task->files as $file)
                                    <li class="flex w-full justify-between">
                                        <a class="text-blue-950 underline"
                                            href="/group/{{ $mainGroup->id }}/task/{{ $task->id }}/show/{{ $file->id }}"
                                            class="w-fit">
                                            {{ $file->name }}
                                        </a>
                                        <a href="/storage/{{ $file->path }}" download>
                                            <p class="cursor-pointer hover:underline">download</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <p class="my-4 text-sm">submitted on
                                {{ $month . ' ' . $day . 'th at ' . $houre . ':' . $minute }}</p>
                            <p>Feedback Message:</p>
                            <p class="text mb-1 text-blue-950">{{ $task->Feedback_Message }}</p>
                        @endif
                        @if (auth()->user()->id == $mainGroup->leader_id && $task->status == 'submitted')
                            <div class="flex w-full">
                                <form action="/group/{{ $mainGroup->id }}/task/{{ $task->id }}"
                                    class="grid w-full rounded-sm border border-blue-900 p-6" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex w-full justify-evenly">
                                        <button
                                            class="mr-2 w-28 rounded-md bg-blue-600 p-2 text-lg text-white hover:scale-95 hover:bg-blue-500"
                                            value="Accept" name="res">Accept</button>
                                        <button
                                            class="mr-4 w-28 rounded-md border border-blue-600 bg-blue-50 p-2 text-lg text-blue-600 hover:scale-95 hover:bg-blue-100"
                                            value="Refuse" name="res">Reject</button>
                                    </div>
                                    <div class="mb-6">
                                        <label for="Feedback_Message" class="mb-2 inline-block">Feedback Message
                                        </label>
                                        <textarea name="Feedback_Message" id="Feedback_Message" class="h-20 w-full rounded border border-gray-200 p-2"
                                            placeholder="Feedback Message">{{ old('Feedback_Message') }}</textarea>
                                        @error('Feedback_Message')
                                            <p class="test-xs mt-1 text-red-500">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-2 flex items-center text-xs text-slate-900"><svg
                                                xmlns="http://www.w3.org/2000/svg" class="mr-1" x="0px" y="0px"
                                                width="18" height="18" viewBox="0 0 50 50">
                                                <path
                                                    d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 25 11 A 3 3 0 0 0 22 14 A 3 3 0 0 0 25 17 A 3 3 0 0 0 28 14 A 3 3 0 0 0 25 11 z M 21 21 L 21 23 L 22 23 L 23 23 L 23 36 L 22 36 L 21 36 L 21 38 L 22 38 L 23 38 L 27 38 L 28 38 L 29 38 L 29 36 L 28 36 L 27 36 L 27 21 L 26 21 L 22 21 L 21 21 z">
                                                </path>
                                            </svg>if you accepted this task leave this input empty</p>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div
        class="h-calc-screen items-normal border-gray2-500 right1 flex w-12 flex-col overflow-hidden border-r bg-white md:w-72">
        <div class="min-h-16 flex h-16 items-center border-b border-gray2 px-2 py-3 md:px-5" style="">
            <i class="hidden px-3 md:block">
                <svg class="svg-icon"
                    style="width: 3em; height: 3em;vertical-align: middle;fill: currentColor;overflow: hidden;"
                    viewBox="0 0 1280 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M384 512c123.8 0 224-100.2 224-224S507.8 64 384 64 160 164.2 160 288s100.2 224 224 224z m153.6 64h-16.6c-41.6 20-87.8 32-137 32s-95.2-12-137-32h-16.6C103.2 576 0 679.2 0 806.4V864c0 53 43 96 96 96h576c53 0 96-43 96-96v-57.6c0-127.2-103.2-230.4-230.4-230.4zM960 512c106 0 192-86 192-192s-86-192-192-192-192 86-192 192 86 192 192 192z m96 64h-7.6c-27.8 9.6-57.2 16-88.4 16s-60.6-6.4-88.4-16H864c-40.8 0-78.4 11.8-111.4 30.8 48.8 52.6 79.4 122.4 79.4 199.6v76.8c0 4.4-1 8.6-1.2 12.8H1184c53 0 96-43 96-96 0-123.8-100.2-224-224-224z" />
                </svg>
            </i>
            <p class="hidden font-mon text-2xl font-semibold md:block">
                Colleagues
            </p>

            @if (auth()->user()->id == $mainGroup->leader_id)
                <abbr title="invitations" class="h-6">
                    <a href="/group/{{ $mainGroup->id }}/invitations">
                        <svg fill="#000000" class="md:ml-4" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="30px" height="30px" viewBox="0 0 92 92" enable-background="new 0 0 92 92"
                            xml:space="preserve">
                            <path id="XMLID_1997_"
                                d="M92,39.2c0-0.1,0-0.3,0-0.4c0-0.1,0-0.2-0.1-0.4c0-0.1-0.1-0.3-0.1-0.4c0-0.1-0.1-0.2-0.1-0.4 c-0.1-0.1-0.1-0.2-0.2-0.3c-0.1-0.1-0.2-0.2-0.2-0.4c0,0-0.1-0.1-0.1-0.1L69.6,10.5C68.8,9.5,67.7,9,66.5,9H25.5 c-1.2,0-2.3,0.5-3.1,1.5L0.9,36.8c0,0-0.1,0.1-0.1,0.1c-0.1,0.1-0.2,0.2-0.2,0.4c-0.1,0.1-0.1,0.2-0.2,0.3c-0.1,0.1-0.1,0.2-0.1,0.4 c0,0.1-0.1,0.2-0.1,0.4c0,0.1-0.1,0.2-0.1,0.4c0,0.1,0,0.3,0,0.4c0,0.1,0,0.1,0,0.2v35.8C0,79.5,3.6,83,8,83H84c4.4,0,8-3.5,8-7.9 V39.3C92,39.3,92,39.2,92,39.2z M27.4,17h37.1l15,18H66.3c-1.1,0-2.2,0.7-3,1.5L54.2,47H37.8l-9.1-10.5c-0.8-0.9-1.8-1.5-3-1.5H12.4 L27.4,17z M84,75L8,75V43h15.9l8.7,10c1,1.2,2.5,2,4.1,2h18.6c1.6,0,3-0.9,4.1-2l8.7-10H84V75z" />
                        </svg>
                    </a>
                </abbr>
                @unless ($invitaion_count == 0)
                    <div
                        class="absolute right-2 top-1 m-auto h-5 w-5 rounded-full bg-red-600 text-center text-sm font-bold text-white">
                        {{ $invitaion_count }}</div>
                @endunless
            @endif
        </div>
        <div class="hidden w-full border-b shadow md:flex">
            <div class="relative text-gray-600">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <button type="submit" class="focus:shadow-outline p-1 focus:outline-none">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" class="h-6 w-6">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </span>
                <input type="text" name="q"
                    class="h-10 w-72 rounded-md py-2 pl-10 text-sm text-white focus:bg-white focus:text-gray-900 focus:outline-none"
                    placeholder="Search..." autocomplete="off" id="members_search">
            </div>
        </div>
        <div class="scrolling h-fittall">
            <!-- Projects Listing goes here -->
            {{-- @dd($members) --}}
            @foreach ($members as $member)
                @php
                    if ($member->profile_url != null) {
                        $profile = '/storage/' . $member->profile_url;
                    } else {
                        $profile = 'profile.JPG';
                    }
                @endphp
                @if ($member->id == auth()->user()->id)
                @else
                    <div class="hoverstyle relative flex h-14 w-full items-center border-b border-blue2 pl-1 md:pl-2"
                        id="m{{ $member->id }}">
                        <a href="/group/{{ $mainGroup->id }}/chat/{{ $member->id }}">
                            <img src="{{ asset($profile) }}" alt=""
                                class="aspect-square h-10 rounded-full bg-gray-300 md:h-12">
                        </a>
                        @if ($mescount[$member->id] != 0)
                            <span
                                class="absolute top-1 h-4 w-4 rounded-full bg-red-600 text-center font-mon text-xs font-semibold text-white md:left-12">{{ $mescount[$member->id] }}</span>
                        @endif
                        <div class="hidden px-2 md:grid">
                            <a href="/group/{{ $mainGroup->id }}/chat/{{ $member->id }}">
                                <div class="grid px-2">
                                    <span
                                        class="title-text-sm font-mon text-lg font-medium">{{ $member->name }}</span>
                                </div>
                            </a>
                        </div>
                        @if (auth()->user()->id == $mainGroup->leader_id)
                            <abbr title="remove">
                                <a href="/group/{{ $mainGroup->id }}/kick_out/{{ $member->id }}">
                                    <svg fill="#000000" height="20px" width="20px" class="left-12 hidden md:flex"
                                        version="1.1" id="Capa_1" viewBox="0 0 56 56" xml:space="preserve">
                                        <g>
                                            <path d="M54.424,28.382c0.101-0.244,0.101-0.519,0-0.764c-0.051-0.123-0.125-0.234-0.217-0.327L42.208,15.293
                                                c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L51.087,27H20.501c-0.552,0-1,0.447-1,1s0.448,1,1,1h30.586L40.794,39.293
                                                c-0.391,0.391-0.391,1.023,0,1.414C40.989,40.902,41.245,41,41.501,41s0.512-0.098,0.707-0.293l11.999-11.999
                                                C54.299,28.616,54.373,28.505,54.424,28.382z" />
                                            <path
                                                d="M36.501,33c-0.552,0-1,0.447-1,1v20h-32V2h32v20c0,0.553,0.448,1,1,1s1-0.447,1-1V1c0-0.553-0.448-1-1-1h-34
                                                c-0.552,0-1,0.447-1,1v54c0,0.553,0.448,1,1,1h34c0.552,0,1-0.447,1-1V34C37.501,33.447,37.053,33,36.501,33z" />
                                        </g>
                                    </svg>
                                </a>
                            </abbr>
                        @endif
                    </div>
                @endif
            @endforeach


            <!-- Projects Listing goes here -->
        </div>
        <div class="gpt flex h-40 w-full items-start pt-3 md:pl-2">
            <div class="gpt flex items-center">
                <div class="aspect-square h-fit scale-75 rounded-full bg-white p-1 md:scale-100">
                    <a href="/group/{{ $mainGroup->id }}/gemini">
                        <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" height='50px'
                            width='50px'>
                            <path
                                d="M16 8.016A8.522 8.522 0 008.016 16h-.032A8.521 8.521 0 000 8.016v-.032A8.521 8.521 0 007.984 0h.032A8.522 8.522 0 0016 7.984v.032z"
                                fill="url(#prefix__paint0_radial_980_20147)" />
                            <defs>
                                <radialGradient id="prefix__paint0_radial_980_20147" cx="0" cy="0"
                                    r="1" gradientUnits="userSpaceOnUse"
                                    gradientTransform="matrix(16.1326 5.4553 -43.70045 129.2322 1.588 6.503)">
                                    <stop offset=".067" stop-color="#9168C0" />
                                    <stop offset=".343" stop-color="#5684D1" />
                                    <stop offset=".672" stop-color="#1BA1E3" />
                                </radialGradient>
                            </defs>
                        </svg>
                    </a>
                </div>
                <a href="/group/{{ $mainGroup->id }}/gemini">
                    <div class="hidden pl-2 md:grid">
                        <span class="font-mon text-xl font-semibold text-white">need help? ask gemini!</span>
                    </div>
                </a>
            </div>

        </div>
    </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cachedImage = localStorage.getItem('myAppBackgroundImage');
        const divElement = document.getElementById('myDiv');

        if (cachedImage) {
            divElement.style.backgroundImage = `url(${cachedImage})`;
        } else {
            fetch('/img/bg.png')
                .then(response => {
                    // Check for a successful fetch (status code 200-299)
                    if (!response.ok) {
                        throw new Error(`Image fetch failed with status: ${response.status}`);
                    }
                    return response.blob(); // Proceed if successful
                })
                .then(blob => {
                    const reader = new FileReader();
                    reader.onloadend = () => {
                        divElement.style.backgroundImage = `url(${reader.result})`;
                        localStorage.setItem('myAppBackgroundImage', reader.result);
                    }
                    reader.readAsDataURL(blob);
                })
                .catch(error => {
                    console.error('Error loading background image:', error);
                    // Handle the error appropriately (e.g., display a fallback image)
                    // ...
                });
        }
    });
</script>
<script>
    let visible = false
    let showBox = document.getElementById('upload_box');
    const targetDiv = document.getElementById("content1");
    const newElementHTML =
        `<div onclick="showUpload()" id="remove_child" class="w-full h-full bg-white opacity-65 absolute"></div>`;


    var elem = document.getElementById('{{ $mainGroup->id }}');
    elem.scrollIntoView();

    // search functionality for groups
    let data = {{ Js::from($groups) }};
    const groupInput = document.getElementById('group_search');
    groupInput.addEventListener('input', e => {
        console.log(groupInput);
        const value = e.target.value.toLowerCase()
        data.forEach(user => {
            // console.log(value);
            const isVisible = user.title.toLowerCase().includes(value) || user.company.toLowerCase()
                .includes(value)
            document.getElementById(user.id).classList.toggle('hide', !isVisible);
            document.getElementById(user.id).classList.toggle('flex', isVisible);
        })
    })

    let data1 = {{ Js::from($members) }};
    const memberInput = document.getElementById('members_search');
    memberInput.addEventListener('input', e => {
        const value = e.target.value.toLowerCase()
        data1.forEach(user => {
            if (user.id == {{ auth()->user()->id }}) {
                return;
            }
            const isVisible = user.name.toLowerCase().includes(value)
            document.getElementById('m' + user.id).classList.toggle('hide', !isVisible);
            document.getElementById('m' + user.id).classList.toggle('flex', isVisible);
        })
    })

    if (document.getElementById("error")) {
        // 
        setTimeout(showUpload(), 500);
    }
</script>

</html>
