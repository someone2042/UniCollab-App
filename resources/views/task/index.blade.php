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
            background: url({{ asset('img/bg.png') }});
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

<body class="h-screen bg-back background">
    <x-flash-message />
    <header class="bg-header text-black1 sticky top-0 left-0 w-full h-16 z-50">
        <div class=""
            style="display: flex; left: 0; position: absolute; right: 0; justify-content: space-around;">
            <a href="/home">
                <div class="flex-shrink-0 h-16 flex items-center pointer" style="position: absolute; left: 0;">
                    <img class="h-12 w-12" src="{{ asset('img/logo.png') }}" alt="Logo">
                    <p class="font-mon font-bold text-2xl mx-5">UniCollab</p>
                </div>
            </a>
            <ul class="flex space-x-4 pr-5 m-4" style=" position: absolute; right: 0; margin: 16px;">
                <a href="/profile">
                    <li>
                        @if (auth()->user()->profile_url != null)
                            <img src="{{ asset('/storage/' . auth()->user()->profile_url) }}"
                                class="size-10 rounded-full ">
                        @else
                            <a class="size-10 rounded-full" href="/profile">
                                <svg class="h-9 w-9 text-black1-500 pointer" fill="none" viewBox="0 0 24 24"
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
                            <svg class="h-9 w-9 text-black1-500 pointer" width="24" height="24"
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
        <div class="bg-white w-72 h-calc-screen border-r border-gray2-500 hidden lg:flex flex-col items-normal">
            <div class="flex py-3 items-center border-b border-gray2 h-16">
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
                <p class="font-mon font-semibold text-2xl">
                    Groups
                </p>
            </div>
            <div class=" w-full border-b flex shadow">
                <div class="relative text-gray-600">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </span>
                    <input type="text" name="q"
                        class="py-2 text-sm text-white  rounded-md pl-10 w-72 focus:outline-none focus:bg-white focus:text-gray-900 h-10"
                        placeholder="Search..." autocomplete="off" id="group_search">
                </div>
            </div>
            <div class="scrolling h-fittall">
                <!-- Projects Listing goes here -->
                @foreach ($groups as $group)
                    @if ($group->id == $mainGroup->id)
                        <div class="w-full border-b border-r-4 border-r-blue1 bg-blue2 border-blue2 h-20 pl-2 flex items-center"
                            id="{{ $group->id }}">
                        @else
                            <div class="w-full border-b border-blue2 h-20 pl-2 flex items-center hoverstyle"
                                id="{{ $group->id }}">
                    @endif
                    <div class="grid px-2 ">
                        <a href="/group/{{ $group->id }}"><span
                                class="font-mon font-medium title-text ">{{ $group->title }} </span></a>
                        <span class="font-mon text-gray1 font-medium text-xs title-text-sm">{{ $group->company }}
                        </span>
                    </div>

            </div>
            @endforeach
            <!-- Projects Listing goes here -->
        </div>
    </div>
    <div class="center">
        <div class="header1 h-16 overflow-hidden">
            <div class="w-1/4  h-full grid items-center hoverstyle">
                <a href="/group/{{ $mainGroup->id }}/chat">
                    <p class="font-mon font-semibold hidden sm:block text-xl border-r border-blue1">Chat</p>

                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" class="sm:hidden m-auto"
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
            <div class="w-1/4 h-full grid items-center hoverstyle border-b-4 border-blue1">
                <a href="/group/{{ $mainGroup->id }}/task" class="relative">
                    <p class="font-mon font-semibold text-xl hidden sm:block border-r border-blue1">Tasks</p>

                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" class="sm:hidden m-auto"
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
                            class="absolute bg-red-600 bottom-3 right-10 h-4 w-4 rounded-full text-xs text-center text-white font-semibold font-mon">{{ $taskcount }}</span>
                    @endif
                </a>
            </div>
            <div class="w-1/4 h-full grid items-center hoverstyle ">
                <a href="/group/{{ $mainGroup->id }}/documents">
                    <p class="font-mon font-semibold text-xl hidden sm:block border-r border-blue1 ">Documents</p>

                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" class="sm:hidden m-auto"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.4299 14.55H9.42993" stroke="#1967D2" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M22 11V17C22 21 21 22 17 22H7C3 22 2 21 2 17V7C2 3 3 2 7 2H8.5C10 2 10.33 2.44 10.9 3.2L12.4 5.2C12.78 5.7 13 6 14 6H17C21 6 22 7 22 11Z"
                            stroke="#1967D2" stroke-width="1.5" stroke-miterlimit="10" />
                    </svg>
                </a>
            </div>
            <div class="w-1/4 h-full grid items-center hoverstyle ">
                <a href="/group/{{ $mainGroup->id }}/projects">
                    <p class="font-mon font-semibold text-xl hidden sm:block ">Project</p>


                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" class="sm:hidden m-auto"
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
        <div id="content1" class="content1 overflow-auto h-calc-screen2">
            {{-- <div class="w-full h-full bg-white opacity-65 absolute"></div> --}}
            <div class="backimage h-full w-full bg-center">
            </div>
            <style>
                .parent-div {
                    width: 100%;
                    /* Set the parent div to 90% of its container */
                    margin: 0 auto;
                    /* Center the parent div horizontally */
                    text-align: center;
                    /* Optionally, center the content within the parent div */
                }

                .child-div {
                    width: 98%;
                    /* Set each child div to 90% of its parent's width */
                    margin: 10px auto;
                    height: 100px;
                    background: #fff;
                    box-shadow: 0 1px 5px #00000022;
                    border-radius: 5px;
                    border: solid #1967D2 1px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }

                .h-1\/12 {
                    height: 8.33333333333%;
                }

                .h-11\/12 {
                    height: 91.6666666663%;
                }

                .old {
                    filter: saturate(0.8) opacity(.7);
                }
            </style>
            <div class="parent-div content-start h-11/12 overflow-auto">
                @if (count($tasks) == 0)
                    <p
                        class="text-6xl fixed bottom-1/2 w-1/2 top-1/2 z-0 text-center font-semibold text-gray-800 opacity-50">
                        No task yet</p>
                @endif
                @foreach ($tasks as $task)
                    @php
                        $date = $task->created_at;
                        $day = $date->format('d'); // Day of the month (01-31)
                        $month = $date->format('M'); // Month as numeric (01-12)
                        $deadline = $task->deadline;

                        $start = Carbon\Carbon::parse(time());
                        $end = Carbon\Carbon::parse($task->deadline);
                        $left_day = $end->diffInDays($start);
                        $left_hour = $end->diffInHours($start) % 24;
                        $left_minute = $end->diffInMinutes($start) % 60;

                        $date = $task->deadline; // Replace with your desired date
                        $now = Carbon\Carbon::now();
                        $difference = $now->diffInMinutes($date, false);

                        // dd($difference)
                        // $dateTimeObject1 = date_create($task->deadline);
                        // $dateTimeObject2 = date_create(time());
                        // $interval = date_diff($dateTimeObject1, $dateTimeObject2);
                        // dd($interval);

                    @endphp
                    <div
                        class="child-div
                    @if ($task->status != 'assigned' && $task->status != 'submitted') old @endif
                    ">
                        <a href="/group/{{ $mainGroup->id }}/task/{{ $task->id }}">
                            <div class="w-1/12">
                                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                <svg fill="#000000" width="50px" height="50px" viewBox="0 0 32 32"
                                    id="icon" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: none;
                                            }
                                        </style>
                                    </defs>
                                    <title>task</title>
                                    <polygon fill="#1967D2"
                                        points="14 20.18 10.41 16.59 9 18 14 23 23 14 21.59 12.58 14 20.18" />
                                    <path fill="#1967D2"
                                        d="M25,5H22V4a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2V5H7A2,2,0,0,0,5,7V28a2,2,0,0,0,2,2H25a2,2,0,0,0,2-2V7A2,2,0,0,0,25,5ZM12,4h8V8H12ZM25,28H7V7h3v3H22V7h3Z"
                                        transform="translate(0 0)" />
                                    <rect fill="#1967D2" id="_Transparent_Rectangle_"
                                        data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32"
                                        height="32" />
                                </svg>
                            </div>
                        </a>
                        <div class="w-11/12 pr-3 grid h-full">
                            <a href="/group/{{ $mainGroup->id }}/task/{{ $task->id }}">
                                <div class="flex justify-between h-16 items-center">
                                    <div class="text-xl font-semibold text-blue1 font-mon">{{ $task->title }}</div>
                                    @if (auth()->user()->id == $mainGroup->leader_id)
                                        <p class="text-sm font-mon text-gray-700">{{ $task->user->name }}</p>
                                    @endif

                                    @if ($difference < 0)
                                        <div class="flex items-center text-sm font-medium text-red-600">
                                        @else
                                            <div class="flex items-center text-sm font-medium text-yellow-600">
                                    @endif
                                    @if ($task->status == 'assigned')
                                        @if ($difference < 0)
                                            <svg height="25px" width="25px" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                viewBox="0 0 192.146 192.146" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path style="fill:#dc2626;" d="M108.186,144.372c0,7.054-4.729,12.32-12.037,12.32h-0.254c-7.054,0-11.92-5.266-11.92-12.32
                                                        c0-7.298,5.012-12.31,12.174-12.31C103.311,132.062,108.059,137.054,108.186,144.372z M88.44,125.301h15.447l2.951-61.298H85.46
                                                        L88.44,125.301z M190.372,177.034c-2.237,3.664-6.214,5.921-10.493,5.921H12.282c-4.426,0-8.51-2.384-10.698-6.233
                                                        c-2.159-3.849-2.11-8.549,0.147-12.349l84.111-149.22c2.208-3.722,6.204-5.96,10.522-5.96h0.332
                                                        c4.445,0.107,8.441,2.618,10.513,6.546l83.515,149.229C192.717,168.768,192.629,173.331,190.372,177.034z M179.879,170.634
                                                        L96.354,21.454L12.292,170.634H179.879z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        @else
                                            <svg fill="#ca8a04" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="15px"
                                                height="15px" viewBox="0 0 473.068 473.068" xml:space="preserve">
                                                <g>
                                                    <g id="Layer_2_31_">
                                                        <g>
                                                            <path d="M355.507,181.955c8.793-6.139,29.39-20.519,29.39-55.351v-71.77h9.814c4.49,0,8.17-3.679,8.17-8.169v-38.5
                                                        c0-4.49-3.681-8.165-8.17-8.165H78.351c-4.495,0-8.165,3.675-8.165,8.165v38.5c0,4.491,3.67,8.169,8.165,8.169h9.82v73.071
                                                        c0,34.499,10.502,42.576,29.074,53.89l80.745,49.203v20.984c-20.346,12.23-73.465,44.242-80.434,49.107
                                                        c-8.793,6.135-29.384,20.51-29.384,55.352v61.793h-9.82c-4.495,0-8.165,3.676-8.165,8.166v38.498c0,4.49,3.67,8.17,8.165,8.17
                                                        h316.361c4.49,0,8.17-3.68,8.17-8.17V426.4c0-4.49-3.681-8.166-8.17-8.166h-9.814v-63.104c0-34.493-10.508-42.572-29.069-53.885
                                                        l-80.745-49.202v-20.987C295.417,218.831,348.537,186.822,355.507,181.955z M252.726,272.859l87.802,53.5
                                                        c6.734,4.109,10.333,6.373,12.001,9.002c1.991,3.164,2.963,9.627,2.963,19.768v63.104H117.574v-61.793
                                                        c0-19.507,9.718-26.289,16.81-31.242c5.551-3.865,54.402-33.389,85.878-52.289c4.428-2.658,7.135-7.441,7.135-12.611v-37.563
                                                        c0-5.123-2.671-9.883-7.053-12.55l-87.54-53.339l-0.265-0.165c-6.741-4.105-10.336-6.369-11.998-9.009
                                                        c-1.992-3.156-2.968-9.626-2.968-19.767V54.835h237.918v71.77c0,19.5-9.718,26.288-16.814,31.235
                                                        c-5.546,3.872-54.391,33.395-85.869,52.295c-4.427,2.658-7.134,7.442-7.134,12.601v37.563
                                                        C245.675,265.431,248.346,270.188,252.726,272.859z" />
                                                            <path d="M331.065,154.234c0,0,5.291-4.619-2.801-3.299c-19.178,3.115-53.079,15.133-92.079,15.133s-57-11-82.507-11.303
                                                        c-5.569-0.066-5.456,3.629,0.937,7.391c6.386,3.758,63.772,35.681,71.671,40.08c7.896,4.389,12.417,4.05,20.786,0
                                                        C259.246,196.334,331.065,154.234,331.065,154.234z" />
                                                            <path d="M154.311,397.564c-6.748,6.209-9.978,10.713,5.536,10.713c12.656,0,139.332,0,155.442,0
                                                        c16.099,0,9.856-5.453,2.311-12.643c-14.576-13.883-45.416-23.566-82.414-23.566
                                                        C196.432,372.068,169.342,383.723,154.311,397.564z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        @endif
                                        {{-- {{$sign}} --}}
                                        @if ($difference < 0)
                                            -
                                        @endif
                                        @if ($left_day != 0)
                                            {{ $left_day }}d
                                        @endif
                                        @if ($left_hour != 0)
                                            {{ $left_hour }}h
                                        @endif
                                        @if ($left_minute != 0)
                                            {{ $left_minute }}m
                                        @endif
                                    @else
                                        @if ($task->status == 'submitted')
                                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                                                    stroke="#facc15" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M12 6V12" stroke="#facc15" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M16.24 16.24L12 12" stroke="#facc15" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        @endif
                                        @if ($task->status == 'accepted')
                                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="10" stroke="#16a34a"
                                                    stroke-width="1.5" />
                                                <path d="M8.5 12.5L10.5 14.5L15.5 9.5" stroke="#16a34a"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        @endif
                                        @if ($task->status == 'rejected')
                                            <svg width="30px" height="30px" viewBox="0 0 1024 1024"
                                                fill="#dc2626" class="icon" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M332 663.2c-9.6 9.6-9.6 25.6 0 35.2s25.6 9.6 35.2 0l349.6-356c9.6-9.6 9.6-25.6 0-35.2s-25.6-9.6-35.2 0L332 663.2z"
                                                    fill="#dc2626" />
                                                <path
                                                    d="M681.6 698.4c9.6 9.6 25.6 9.6 35.2 0s9.6-25.6 0-35.2L367.2 307.2c-9.6-9.6-25.6-9.6-35.2 0s-9.6 25.6 0 35.2l349.6 356z"
                                                    fill="#dc2626" />
                                                <path
                                                    d="M516.8 1014.4c-277.6 0-503.2-225.6-503.2-503.2S239.2 7.2 516.8 7.2s503.2 225.6 503.2 503.2-225.6 504-503.2 504z m0-959.2c-251.2 0-455.2 204.8-455.2 456s204 455.2 455.2 455.2 455.2-204 455.2-455.2-204-456-455.2-456z"
                                                    fill="" />
                                            </svg>
                                        @endif
                                    @endif
                                </div>
                        </div>
                        </a>
                        <a href="/group/{{ $mainGroup->id }}/task/{{ $task->id }}">
                            <div class="flex justify-between h-9 pt-2 text-gray-600">
                                <div class="w-11/12 ">
                                    <p class="title-text-sm text-sm text-start font-semibold">
                                        {{ $task->description }}
                                    </p>
                                </div>
                                <div class="w-2/12 text-sm flex justify-end items-center">
                                    @if (auth()->user()->id == $mainGroup->leader_id)
                                        <form method="POST"
                                            action="/group/{{ $mainGroup->id }}/task/{{ $task->id }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit">
                                                <svg width="15px" height="15px" viewBox="-3 0 32 32"
                                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">

                                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd" sketch:type="MSPage">
                                                        <g id="Icon-Set" sketch:type="MSLayerGroup"
                                                            transform="translate(-259.000000, -203.000000)"
                                                            fill="#000000">
                                                            <path
                                                                d="M282,211 L262,211 C261.448,211 261,210.553 261,210 C261,209.448 261.448,209 262,209 L282,209 C282.552,209 283,209.448 283,210 C283,210.553 282.552,211 282,211 L282,211 Z M281,231 C281,232.104 280.104,233 279,233 L265,233 C263.896,233 263,232.104 263,231 L263,213 L281,213 L281,231 L281,231 Z M269,206 C269,205.447 269.448,205 270,205 L274,205 C274.552,205 275,205.447 275,206 L275,207 L269,207 L269,206 L269,206 Z M283,207 L277,207 L277,205 C277,203.896 276.104,203 275,203 L269,203 C267.896,203 267,203.896 267,205 L267,207 L261,207 C259.896,207 259,207.896 259,209 L259,211 C259,212.104 259.896,213 261,213 L261,231 C261,233.209 262.791,235 265,235 L279,235 C281.209,235 283,233.209 283,231 L283,213 C284.104,213 285,212.104 285,211 L285,209 C285,207.896 284.104,207 283,207 L283,207 Z M272,231 C272.552,231 273,230.553 273,230 L273,218 C273,217.448 272.552,217 272,217 C271.448,217 271,217.448 271,218 L271,230 C271,230.553 271.448,231 272,231 L272,231 Z M267,231 C267.552,231 268,230.553 268,230 L268,218 C268,217.448 267.552,217 267,217 C266.448,217 266,217.448 266,218 L266,230 C266,230.553 266.448,231 267,231 L267,231 Z M277,231 C277.552,231 278,230.553 278,230 L278,218 C278,217.448 277.552,217 277,217 C276.448,217 276,217.448 276,218 L276,230 C276,230.553 276.448,231 277,231 L277,231 Z"
                                                                id="trash" sketch:type="MSShapeGroup">

                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    <p>{{ $day . ' ' . $month }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
            </div>
            @endforeach
        </div>
        @if (auth()->user()->id == $mainGroup->leader_id)
            <a href="/group/{{ $mainGroup->id }}/task/create">
                <div onclick="showUpload()"
                    class="cursor-pointer sticky flex justify-end bottom-0 h-1/12 w-full z-40 bg-white shadow-2xl shadow-black ">
                    <div class="mx-4 mt-1 bg-blue-500 absolute right-3 p-2 bottom-1 h-fit rounded-full">
                        <?xml version="1.0" ?>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg" height='35px' width='35px'>
                            <rect fill="none" height="200" width="200" />
                            <line fill="none" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="35" x1="40" x2="216" y1="128" y2="128" />
                            <line fill="none" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="35" x1="128" x2="128" y1="40" y2="216" />
                        </svg>
                    </div>
                </div>
            </a>
        @endif
    </div>
    </div>
    <div
        class="bg-white w-12 md:w-72 h-calc-screen border-r overflow-hidden flex flex-col items-normal border-gray2-500 right1">
        <div class="flex px-2 md:px-5 items-center py-3 border-b border-gray2 min-h-16 h-16" style="">
            <i class="px-3 hidden md:block">
                <svg class="svg-icon"
                    style="width: 3em; height: 3em;vertical-align: middle;fill: currentColor;overflow: hidden;"
                    viewBox="0 0 1280 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M384 512c123.8 0 224-100.2 224-224S507.8 64 384 64 160 164.2 160 288s100.2 224 224 224z m153.6 64h-16.6c-41.6 20-87.8 32-137 32s-95.2-12-137-32h-16.6C103.2 576 0 679.2 0 806.4V864c0 53 43 96 96 96h576c53 0 96-43 96-96v-57.6c0-127.2-103.2-230.4-230.4-230.4zM960 512c106 0 192-86 192-192s-86-192-192-192-192 86-192 192 86 192 192 192z m96 64h-7.6c-27.8 9.6-57.2 16-88.4 16s-60.6-6.4-88.4-16H864c-40.8 0-78.4 11.8-111.4 30.8 48.8 52.6 79.4 122.4 79.4 199.6v76.8c0 4.4-1 8.6-1.2 12.8H1184c53 0 96-43 96-96 0-123.8-100.2-224-224-224z" />
                </svg>
            </i>
            <p class="font-mon font-semibold hidden md:block text-2xl">
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
                        class="w-5 h-5 rounded-full text-center m-auto absolute bg-red-600 right-2 text-white font-bold top-1 text-sm">
                        {{ $invitaion_count }}</div>
                @endunless
            @endif
        </div>
        <div class=" w-full hidden border-b md:flex shadow">
            <div class="relative text-gray-600">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </span>
                <input type="text" name="q"
                    class="py-2 text-sm text-white  rounded-md pl-10 w-72 focus:outline-none focus:bg-white focus:text-gray-900 h-10"
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
                    <div class="w-full border-b border-blue2 h-14 pl-1 md:pl-2 flex items-center hoverstyle relative"
                        id="m{{ $member->id }}">
                        <a href="/group/{{ $mainGroup->id }}/chat/{{ $member->id }}">
                            <img src="{{ asset($profile) }}" alt=""
                                class="bg-gray-300 rounded-full h-10 md:h-12 aspect-square">
                        </a>
                        @if ($mescount[$member->id] != 0)
                            <span
                                class="absolute bg-red-600 top-1  md:left-12 h-4 w-4 rounded-full text-xs text-center text-white font-semibold font-mon">{{ $mescount[$member->id] }}</span>
                        @endif
                        <div class="px-2 hidden md:grid">
                            <a href="/group/{{ $mainGroup->id }}/chat/{{ $member->id }}">
                                <div class="grid px-2 ">
                                    <span
                                        class="font-mon font-medium text-lg title-text-sm">{{ $member->name }}</span>
                                </div>
                            </a>
                        </div>
                        @if (auth()->user()->id == $mainGroup->leader_id)
                            <abbr title="remove">
                                <a href="/group/{{ $mainGroup->id }}/kick_out/{{ $member->id }}">
                                    <svg fill="#000000" height="20px" width="20px" class="hidden md:flex left-12"
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
        <div class="w-full h-40 md:pl-2 pt-3 gpt flex items-start  ">
            <div class=" gpt flex items-center">
                <div class="bg-white rounded-full scale-75 p-1 md:scale-100 h-fit aspect-square">
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
                    <div class="hidden md:grid pl-2 ">
                        <span class="font-mon font-semibold text-white text-xl">need help? ask gemini!</span>
                    </div>
                </a>
            </div>

        </div>
    </div>
    </div>
</body>
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

    const whatever = document.getElementById("error").innerHTML;
    console.log(whatever);
    // nameInput.addEventListener("invalid", join);
    if (empt != null && empt != "") {
        // 
        setTimeout(showUpload(), 500);
    }
</script>

</html>
