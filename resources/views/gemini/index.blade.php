<!DOCTYPE html>
<html lang="en">

<head>
    {{-- @php
    dd($mainGroup);
    @endphp --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <link href="./output.css" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

        @layer base {

            ul,
            ol {
                list-style: revert-layer;
            }
        }

        .center {
            flex-grow: 1;
            /* Allow center div to grow and fill remaining space */
            position: fixed;
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

        pre {
            width: 100%;
            overflow-x: auto;
        }
    </style>
</head>

<body class="h-screen bg-slate-900 background">
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
            <div class="w-1/4 h-full grid items-center hoverstyle">
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
            <div class="w-1/4 h-full grid items-center hoverstyle">
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
            <div class="w-1/4 h-full grid items-center hoverstyle">
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
            <style>
                .parent-div {
                    width: 100%;
                    /* Set the parent div to 90% of its container */
                    margin: 0 auto;
                    height: 100%;
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

                .max-w-4\/5 {
                    max-width: 80%;
                }

                .bg-dark-blue {
                    background-color: #103C78;
                }

                .text-dark-blue {
                    color: #103C78;
                }

                .bg-dark-blue2 {
                    background-color: #1e66cb;
                }
            </style>
            <div class="backimage h-full w-full bg-center">
            </div>
            <div class="parent-div content-start overflow-auto">
                <div class="w-full h-11/12 flex flex-wrap content-start overflow-auto p-5" id="messagediv">
                    <div class="message hidden"></div>
                </div>
                <div class="w-full h-1/12">
                    <form id="form" class="flex h-full w-full justify-evenly pb-1 items-center">
                        @csrf
                        <input type="text" id="content" name="content"
                            class="w-11/12 h-full rounded-full px-3 text-sm outline-none bg-slate-900 border-slate-600 text-slate-300 border shadow-lg"
                            placeholder="Enter Prompt here" autocomplete="off">
                        <button class="">
                            <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                            <svg fill="#cbd5e1" width="40px" height="40px" viewBox="0 0 32 32" id="icon"
                                xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: none;
                                        }
                                    </style>
                                </defs>
                                <title>send--alt--filled</title>
                                <path
                                    d="M27.71,4.29a1,1,0,0,0-1.05-.23l-22,8a1,1,0,0,0,0,1.87l8.59,3.43L19.59,11,21,12.41l-6.37,6.37,3.44,8.59A1,1,0,0,0,19,28h0a1,1,0,0,0,.92-.66l8-22A1,1,0,0,0,27.71,4.29Z" />
                                <rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;"
                                    class="cls-1" width="32" height="32" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

<!-- and it's easy to individually load additional languages -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/go.min.js"></script>
<script>
    hljs.highlightAll();
</script>
<script src="https://cdn.jsdelivr.net/npm/showdown@2.1.0/dist/showdown.min.js"></script>
<script>
    var converter = new showdown.Converter()

    $("#form").submit(function(event) {
        event.preventDefault();
        let val = $("#content").val();
        if ($("#content").val() == null || $("#content").val() == '' || $("#content").val() == ' ') {
            return;
        }
        messageHtml = `
                    <div class=" m-1 w-full h-fit flex justify-end message">
                        <div class="bg-slate-500 max-w-4/5 rounded-b-xl rounded-l-xl">
                            <div class="text-left text-gray-200 pr-5 py-2 pl-2 font-mon chattext">` + $("#content")
            .val() + `</div>
                            <p class="text-xs text-end mr-2 text-white"></p>
                        </div>
                    </div>`;
        $(".message").last().after(messageHtml);
        let elements = document.querySelectorAll(".message");
        let lastElement = elements[elements.length - 1];
        lastElement.scrollIntoView();
        $("#content").val('');
        messageHtml =
            `<div class=" m-1 w-full h-fit flex message" id='loading'>
                <div class="w-8 h-8 mr-1 rounded-full animate-spin">
                    
                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M16 8.016A8.522 8.522 0 008.016 16h-.032A8.521 8.521 0 000 8.016v-.032A8.521 8.521 0 007.984 0h.032A8.522 8.522 0 0016 7.984v.032z" fill="url(#prefix__paint0_radial_980_20147)"/><defs><radialGradient id="prefix__paint0_radial_980_20147" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="matrix(16.1326 5.4553 -43.70045 129.2322 1.588 6.503)"><stop offset=".067" stop-color="#9168C0"/><stop offset=".343" stop-color="#5684D1"/><stop offset=".672" stop-color="#1BA1E3"/></radialGradient></defs></svg>
                </div>
            </div>`;
        $(".message").last().after(messageHtml);
        elements = document.querySelectorAll(".message");
        lastElement = elements[elements.length - 1];
        lastElement.scrollIntoView();
        let texts = [];
        $(".chattext").each(function() {
            texts.push($(this).text());
        });

        $.ajax({
            url: "/group/{{ $mainGroup->id }}/gemini",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                content: val,
                group: {{ $mainGroup->id }},
                text: texts,
            }
        }).done(function(res) {
            console.log(res);
            let text = converter.makeHtml(res.responseData);

            messageHtml =
                `<div class=" m-1 w-full h-fit flex message">
                    <div class="w-8 h-8 min-w-8 mr-1 rounded-full">

                        <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M16 8.016A8.522 8.522 0 008.016 16h-.032A8.521 8.521 0 000 8.016v-.032A8.521 8.521 0 007.984 0h.032A8.522 8.522 0 0016 7.984v.032z" fill="url(#prefix__paint0_radial_980_20147)"/><defs><radialGradient id="prefix__paint0_radial_980_20147" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="matrix(16.1326 5.4553 -43.70045 129.2322 1.588 6.503)"><stop offset=".067" stop-color="#9168C0"/><stop offset=".343" stop-color="#5684D1"/><stop offset=".672" stop-color="#1BA1E3"/></radialGradient></defs></svg>
                    </div>
                    <div class="grid max-w-full overflow-y-auto">
                        <p class=" text-left text-dark-blue px-2 font-mon font-medium"></p>
                        <div class="bg-slate-600 overflow-y-auto w-full rounded-b-xl rounded-r-xl">
                            <div class="text-left text-sm text-gray-200 px-2 py-2 font-mon chattext ">` + text + `</div>
                            <p class="text-xs text-end mr-2 text-white"></p>
                        </div>
                    </div>
                </div>`;
            $("#loading").remove();
            $(".message").last().after(messageHtml);
            const elements = document.querySelectorAll(".message");
            const lastElement = elements[elements.length - 1];
            lastElement.scrollIntoView();
            hljs.highlightAll();
        });
    });


    // Example usage:

    // /group/{{ $mainGroup->id }}/gemini

    // const text = jsonData.text;

    // // Function to escape HTML characters for safe rendering

    // function convertToBasicHtml(text) {
    //     const paragraphs = text.split(/\n\n/g);

    // // Wrap each paragraph with <p> tags
    // paragraphs.forEach((paragraph, index) => {
    //     paragraphs[index] = `<p>${paragraph.replace(/\n/g, '<br>')}</p>`;
    // });

    // return paragraphs.join('');
    // }

    // const html = convertToBasicHtml(text);

    // document.getElementById('messagediv').innerHTML = html;
</script>
<script>
    var elem = document.getElementById('{{ $mainGroup->id }}');
    elem.scrollIntoView();

    // search functionality for groups
    let data = {{ Js::from($groups) }};
    const groupInput = document.getElementById('group_search');
    groupInput.addEventListener('input', e => {
        const value = e.target.value.toLowerCase()
        data.forEach(user => {
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

    if (document.getElementById("error") != null) {
        const whatever = document.getElementById("error").innerHTML;
        // nameInput.addEventListener("invalid", join);
        if (empt != null && empt != "") {
            // 
            setTimeout(showUpload(), 500);
        }
    }
    const elements = document.querySelectorAll(".message");
    const lastElement = elements[elements.length - 1];
    lastElement.scrollIntoView();
</script>


</html>
