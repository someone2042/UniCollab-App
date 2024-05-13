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
    <link href="{{asset('img/logo.png')}}" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @vite('resources/css/app.css')
    <title>UniColab</title>
    <style>
        .hide{
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
            position: fixed;
            left: 320px;
            right: 288px;
            min-width: 420px;
            overflow-x: visible
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
            background: url({{asset("img/bg.png")}});
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
        .title-text{
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* number of lines to show */
            line-clamp: 2; 
            -webkit-box-orient: vertical;
        }
        .title-text-sm{
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1; /* number of lines to show */
            line-clamp: 1; 
            -webkit-box-orient: vertical;
        }
        .h-fittall{
            height: -webkit-fill-available;
        }
        </style>
</head>

<body class="h-screen bg-back background">
    <x-flash-message />
    <header class="bg-header text-black1 sticky top-0 left-0 w-full h-16 z-50">
        <div class="" style="display: flex; left: 0; position: absolute; right: 0; justify-content: space-around;">
            <a href="/home">
                <div class="flex-shrink-0 h-16 flex items-center pointer" style="position: absolute; left: 0;">
                    <img class="h-12 w-12" src="{{asset('img/logo.png')}}" alt="Logo">
                    <p class="font-mon font-bold text-2xl mx-5">UniCollab</p>
                </div>
            </a>
            <ul class="flex space-x-4 pr-5 m-4" style=" position: absolute; right: 0; margin: 16px;">
                <a href="/profile">
                    <li>
                       @if (auth()->user()->profile_url!=NULL)
                       <img src="{{asset("/storage/".auth()->user()->profile_url)}}"  class="size-10 rounded-full ">
                       @else
                          <a class="size-10 rounded-full" href="/profile">
                             <svg class="h-9 w-9 text-black1-500 pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                             </svg>
                          </a>
                       @endif
                    </li>
                 </a>
                 <li class="mt-1">
                    <form action="/logout" method="POST">
                       @csrf
                       <button type="submit">
                          <svg class="h-9 w-9 text-black1-500 pointer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" />
                             <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
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
            display: flex; /* Use flexbox for horizontal arrangement */
            flex-wrap: wrap; /* Wrap child divs to the next line if they overflow */
            width: 100%; /* Set width to 100% to take up the full container */
            margin: 0 auto; /* Optionally center the parent div horizontally */
            justify-content: space-evenly;
        }
        .child-div {
            width: 150px; /* Set a fixed width for each child div */
            height: 200px; /* Set a fixed height for each child div (optional) */
            margin: 1px; /* Add optional margins between child divs */
            /* background-color: #717171; */
             /* Optional background color for visual distinction */
            /* background-image: url('/file.png'); */
        }
        .file{
            height: 175px;
            width: 100%;
            /* background-image: url('/file.png'); */
        }
    </style>
    <div class="container1">
        <div class="bg-white w-80 h-calc-screen border-r border-gray2-500 flex flex-col items-normal">
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
                        <div class="w-full border-b border-blue2 h-20 pl-2 flex items-center hoverstyle" id="{{$group->id}}">
                        <div class="bg-gray-300 rounded-full h-14 aspect-square">

                        </div>
                        <div class="grid px-2 ">
                            <a href="/group/{{$group->id}}"><span class="font-mon font-medium title-text ">{{$group->title}} </span></a>
                            <span class="font-mon text-gray1 font-medium text-xs title-text-sm">{{$group->company}} </span>
                        </div>

                    </div>
                @endforeach
                <!-- Projects Listing goes here -->
            </div>
        </div>
        <div class="center">
            <div class="header1 h-16 overflow-hidden">
                <div class="w-1/4  h-full grid items-center hoverstyle">
                    <a href="/group/{{$mainGroup->id}}/chat">
                        <p class="font-mon font-semibold text-xl border-r border-blue1">Chat</p>
                    </a>
                </div>
                <div class="w-1/4 h-full grid items-center hoverstyle">
                    <a href="/group/{{$mainGroup->id}}/task">
                        <p class="font-mon font-semibold text-xl border-r border-blue1">Tasks</p>
                    </a>
                </div>
                <div class="w-1/4 h-full grid items-center hoverstyle">
                    <a href="/group/{{$mainGroup->id}}/documents">
                        <p class="font-mon font-semibold text-xl border-r border-blue1 ">Documents</p>
                    </a>
                </div>
                <div class="w-1/4 h-full grid items-center hoverstyle">
                    <a href="/group/{{$mainGroup->id}}/projects">
                        <p class="font-mon font-semibold text-xl ">Project</p>
                    </a>
                </div>
            </div>
            <div id="content1" class="content1 overflow-auto h-calc-screen2">
                <style>
                    .parent-div {
                        width: 100%; /* Set the parent div to 90% of its container */
                        margin: 0 auto;
                        height: 100%;
                        /* Center the parent div horizontally */
                        text-align: center; /* Optionally, center the content within the parent div */
                    }

                    .child-div {
                        width: 98%; /* Set each child div to 90% of its parent's width */
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
                    .h-1\/12{
                        height: 8.33333333333%;
                    }
                    .h-11\/12{
                        height: 91.6666666663%;
                    }
                    .max-w-4\/5{
                        max-width: 80%;
                    }
                    .bg-dark-blue{
                        background-color: #103C78;
                    }
                    .text-dark-blue{
                        color: #103C78;
                    }
                    .bg-dark-blue2{
                        background-color: #1e66cb;
                    }
                </style>
                <div class="backimage h-full w-full bg-center">
                </div>
                <div class="parent-div content-start overflow-auto">
                    <div class="w-full h-11/12 flex flex-wrap content-start overflow-auto " id="messagediv">
                        @foreach ($messages as $key => $message)
                        @php
                            $date = date('Y-m-d', strtotime($message->created_at));
                            $time = date('H:i', strtotime($message->created_at));
                        @endphp
                            @if ($message->sender_id!=auth()->user()->id)
                                    <div class=" m-1 w-full h-fit flex message">
                                        <div class="bg-dark-blue ml-2 max-w-4/5 rounded-b-xl rounded-r-xl">
                                            <div class="text-left text-sm text-gray-200 px-2 font-mon">{{$message->content}} </div>
                                            <p class="text-xs text-end mx-5 text-white">{{$time}}</p>
                                        </div>
                                    </div>
                            @else

                                <div class=" m-1 w-full h-fit flex justify-end message">
                                    <div class="bg-dark-blue2 max-w-4/5 rounded-b-xl rounded-l-xl">
                                        <div class="text-left text-sm text-gray-200 pr-10 pl-2 font-mon">{{$message->content}} </div>
                                        <p class="text-xs text-end mr-5 text-white">{{$time}}</p>
                                    </div>
                                </div>
                                
                            @endif

                        @endforeach
                        
                    </div>
                    <div class="w-full h-1/12">
                        <form id="form" class="flex h-full w-full justify-evenly pb-1 items-center">
                            @csrf
                            <input type="text" id="content" name="content" class="w-11/12 h-full rounded-full px-3 text-sm outline-none border-blue1 border shadow-lg" placeholder="Message" autocomplete="off" >
                            <button class="">
                                <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                <svg fill="#1967D2" width="40px" height="40px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <style>.cls-1{fill:none;}</style>
                                    </defs>
                                    <title>send--alt--filled</title>
                                    <path d="M27.71,4.29a1,1,0,0,0-1.05-.23l-22,8a1,1,0,0,0,0,1.87l8.59,3.43L19.59,11,21,12.41l-6.37,6.37,3.44,8.59A1,1,0,0,0,19,28h0a1,1,0,0,0,.92-.66l8-22A1,1,0,0,0,27.71,4.29Z"/>
                                    <rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="bg-white w-72 h-calc-screen border-r overflow-hidden flex flex-col items-normal border-gray2-500 right1">
            <div class="flex px-5 items-center border-b border-gray2 h-16" style="">
                <i class="px-3">
                    <svg class="svg-icon"
                        style="width: 3em; height: 3em;vertical-align: middle;fill: currentColor;overflow: hidden;"
                        viewBox="0 0 1280 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M384 512c123.8 0 224-100.2 224-224S507.8 64 384 64 160 164.2 160 288s100.2 224 224 224z m153.6 64h-16.6c-41.6 20-87.8 32-137 32s-95.2-12-137-32h-16.6C103.2 576 0 679.2 0 806.4V864c0 53 43 96 96 96h576c53 0 96-43 96-96v-57.6c0-127.2-103.2-230.4-230.4-230.4zM960 512c106 0 192-86 192-192s-86-192-192-192-192 86-192 192 86 192 192 192z m96 64h-7.6c-27.8 9.6-57.2 16-88.4 16s-60.6-6.4-88.4-16H864c-40.8 0-78.4 11.8-111.4 30.8 48.8 52.6 79.4 122.4 79.4 199.6v76.8c0 4.4-1 8.6-1.2 12.8H1184c53 0 96-43 96-96 0-123.8-100.2-224-224-224z" />
                    </svg>
                </i>
                <p class="font-mon font-semibold text-2xl">
                    Colleagues
                </p>

                @if (auth()->user()->id==$mainGroup->leader_id)
                    <abbr title="invitations">
                        <a href="/group/{{$mainGroup->id}}/invitations">
                            <svg fill="#000000" class="ml-4" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 92 92" enable-background="new 0 0 92 92" xml:space="preserve">
                                <path id="XMLID_1997_" d="M92,39.2c0-0.1,0-0.3,0-0.4c0-0.1,0-0.2-0.1-0.4c0-0.1-0.1-0.3-0.1-0.4c0-0.1-0.1-0.2-0.1-0.4 c-0.1-0.1-0.1-0.2-0.2-0.3c-0.1-0.1-0.2-0.2-0.2-0.4c0,0-0.1-0.1-0.1-0.1L69.6,10.5C68.8,9.5,67.7,9,66.5,9H25.5 c-1.2,0-2.3,0.5-3.1,1.5L0.9,36.8c0,0-0.1,0.1-0.1,0.1c-0.1,0.1-0.2,0.2-0.2,0.4c-0.1,0.1-0.1,0.2-0.2,0.3c-0.1,0.1-0.1,0.2-0.1,0.4 c0,0.1-0.1,0.2-0.1,0.4c0,0.1-0.1,0.2-0.1,0.4c0,0.1,0,0.3,0,0.4c0,0.1,0,0.1,0,0.2v35.8C0,79.5,3.6,83,8,83H84c4.4,0,8-3.5,8-7.9 V39.3C92,39.3,92,39.2,92,39.2z M27.4,17h37.1l15,18H66.3c-1.1,0-2.2,0.7-3,1.5L54.2,47H37.8l-9.1-10.5c-0.8-0.9-1.8-1.5-3-1.5H12.4 L27.4,17z M84,75L8,75V43h15.9l8.7,10c1,1.2,2.5,2,4.1,2h18.6c1.6,0,3-0.9,4.1-2l8.7-10H84V75z"/>
                            </svg>
                        </a>
                    </abbr>
                    @unless ($invitaion_count==0)
                        <div class="w-5 h-5 rounded-full text-center m-auto absolute bg-red-600 right-2 text-white font-bold top-1 text-sm">{{$invitaion_count}}</div>
                    @endunless
                @endif
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
                        placeholder="Search..." autocomplete="off" id="members_search">
                </div>
            </div>
            <div class="scrolling h-fittall">
                <!-- Projects Listing goes here -->
                {{-- @dd($members) --}}
                @foreach ($members as $member)
                    @php
                        if ($member->profile_url != NULL) {
                            $profile="/storage/".$member->profile_url;
                        }
                        else {
                            $profile='profile.JPG';
                        }
                    @endphp
                    @if ($member->id==auth()->user()->id)

                    @else
                        @if ($member->id==$user->id)
                            <div class="w-full border-b border-blue2 border-r-blue1 bg-blue2 h-14 pl-2 flex items-center" id="m{{$member->id}}" >  
                        @else
                            <div class="w-full border-b border-blue2  h-14 pl-2 flex items-center hoverstyle" id="m{{$member->id}}" >  
                        @endif
                            <img src="{{asset($profile)}}" alt="" class="bg-gray-300 rounded-full h-12 aspect-square">
                            <a href="/group/{{$mainGroup->id}}/chat/{{$member->id}}">
                                <div class="grid px-2 ">
                                    <span class="font-mon font-medium text-lg title-text-sm">{{$member->name}}</span>
                                </div>
                            </a>
                            @if (auth()->user()->id==$mainGroup->leader_id)
                                <abbr title="remove">
                                    <a href="/group/{{$mainGroup->id}}/kick_out/{{$member->id}}">
                                        <svg fill="#000000" height="20px" width="20px" class=" left-12" version="1.1" id="Capa_1"  viewBox="0 0 56 56" xml:space="preserve">
                                            <g>
                                                <path d="M54.424,28.382c0.101-0.244,0.101-0.519,0-0.764c-0.051-0.123-0.125-0.234-0.217-0.327L42.208,15.293
                                                    c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L51.087,27H20.501c-0.552,0-1,0.447-1,1s0.448,1,1,1h30.586L40.794,39.293
                                                    c-0.391,0.391-0.391,1.023,0,1.414C40.989,40.902,41.245,41,41.501,41s0.512-0.098,0.707-0.293l11.999-11.999
                                                    C54.299,28.616,54.373,28.505,54.424,28.382z"/>
                                                <path d="M36.501,33c-0.552,0-1,0.447-1,1v20h-32V2h32v20c0,0.553,0.448,1,1,1s1-0.447,1-1V1c0-0.553-0.448-1-1-1h-34
                                                    c-0.552,0-1,0.447-1,1v54c0,0.553,0.448,1,1,1h34c0.552,0,1-0.447,1-1V34C37.501,33.447,37.053,33,36.501,33z"/>
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
            <div class="w-full h-40 pl-2 pt-3 gpt flex items-start  ">
                <div class="pl-2 gpt flex items-center ">
                    <div class="bg-white rounded-full h-fit aspect-square">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                            viewBox="0 0 24 24">
                            <path
                                d="M 11.134766 1.0175781 C 10.87173 1.0049844 10.606766 1.0088281 10.337891 1.0332031 C 8.1135321 1.2338971 6.3362243 2.7940749 5.609375 4.8203125 C 3.8970488 5.1768339 2.4372723 6.3048522 1.671875 7.9570312 C 0.73398779 9.9840533 1.1972842 12.30076 2.5878906 13.943359 C 2.0402591 15.605222 2.2856216 17.434472 3.3320312 18.921875 C 4.6182099 20.747762 6.8565685 21.504693 8.9746094 21.121094 C 10.139659 22.427613 11.84756 23.130452 13.662109 22.966797 C 15.886521 22.766098 17.663809 21.205995 18.390625 19.179688 C 20.102972 18.823145 21.563838 17.695991 22.330078 16.042969 C 23.268167 14.016272 22.805368 11.697142 21.414062 10.054688 C 21.960697 8.3934373 21.713894 6.5648387 20.667969 5.078125 C 19.38179 3.2522378 17.143432 2.4953068 15.025391 2.8789062 C 14.032975 1.7660011 12.646869 1.0899755 11.134766 1.0175781 z M 11.025391 2.5136719 C 11.921917 2.5488523 12.754993 2.8745885 13.431641 3.421875 C 13.318579 3.4779175 13.200103 3.5164101 13.089844 3.5800781 L 9.0761719 5.8964844 C 8.7701719 6.0724844 8.5801719 6.3989531 8.5761719 6.7519531 L 8.5175781 12.238281 L 6.75 11.189453 L 6.75 6.7851562 C 6.75 4.6491563 8.3075938 2.74225 10.433594 2.53125 C 10.632969 2.5115 10.83048 2.5060234 11.025391 2.5136719 z M 16.125 4.2558594 C 17.398584 4.263418 18.639844 4.8251563 19.417969 5.9101562 C 20.070858 6.819587 20.310242 7.9019929 20.146484 8.9472656 C 20.041416 8.8773528 19.948163 8.794144 19.837891 8.7304688 L 15.826172 6.4140625 C 15.520172 6.2380625 15.143937 6.2352031 14.835938 6.4082031 L 10.052734 9.1035156 L 10.076172 7.0488281 L 13.890625 4.8476562 C 14.584375 4.4471562 15.36085 4.2513242 16.125 4.2558594 z M 5.2832031 6.4726562 C 5.2752078 6.5985272 5.25 6.7203978 5.25 6.8476562 L 5.25 11.480469 C 5.25 11.833469 5.4362344 12.159844 5.7402344 12.339844 L 10.464844 15.136719 L 8.6738281 16.142578 L 4.859375 13.939453 C 3.009375 12.871453 2.1365781 10.567094 3.0175781 8.6210938 C 3.4795583 7.6006836 4.2963697 6.8535791 5.2832031 6.4726562 z M 15.326172 7.8574219 L 19.140625 10.060547 C 20.990625 11.128547 21.865375 13.432906 20.984375 15.378906 C 20.522287 16.399554 19.703941 17.146507 18.716797 17.527344 C 18.724764 17.401695 18.75 17.279375 18.75 17.152344 L 18.75 12.521484 C 18.75 12.167484 18.563766 11.840156 18.259766 11.660156 L 13.535156 8.8632812 L 15.326172 7.8574219 z M 12.025391 9.7109375 L 13.994141 10.878906 L 13.966797 13.167969 L 11.974609 14.287109 L 10.005859 13.121094 L 10.03125 10.832031 L 12.025391 9.7109375 z M 15.482422 11.761719 L 17.25 12.810547 L 17.25 17.214844 C 17.25 19.350844 15.692406 21.25775 13.566406 21.46875 C 12.449968 21.579344 11.392114 21.244395 10.568359 20.578125 C 10.681421 20.522082 10.799897 20.48359 10.910156 20.419922 L 14.923828 18.103516 C 15.229828 17.927516 15.419828 17.601047 15.423828 17.248047 L 15.482422 11.761719 z M 13.947266 14.896484 L 13.923828 16.951172 L 10.109375 19.152344 C 8.259375 20.220344 5.8270313 19.825844 4.5820312 18.089844 C 3.9291425 17.180413 3.6897576 16.098007 3.8535156 15.052734 C 3.9587303 15.122795 4.0516754 15.205719 4.1621094 15.269531 L 8.1738281 17.585938 C 8.4798281 17.761938 8.8560625 17.764797 9.1640625 17.591797 L 13.947266 14.896484 z">
                            </path>
                        </svg>
                    </div>
                    <div class="grid px-2 ">
                        <span class="font-mon font-semibold text-white text-xl">need help? ask chat!</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
<script>
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: 'eu'
    });
    let user1_id={{ auth()->user()->id }}
    let user2_id={{$user->id}}
    let chat_id
    if (user1_id>user2_id) {
        chat_id=user1_id+'.'+user2_id
    } else {
        chat_id=user2_id+'.'+user1_id
    }

    const channel = pusher.subscribe("chat"+chat_id);

    channel.bind('new-chat-message', function(data) {
        // Update your UI with the received message data (e.g., append to chat window)

        const datetime = data.time;
        const dateObject = new Date(datetime);
        const hours = dateObject.getHours();
        const minutes = dateObject.getMinutes();

        if(data.userId=={{auth()->user()->id}}){
            messageHtml=`
                <div class=" m-1 w-full h-fit flex justify-end message">
                    <div class="bg-dark-blue2 max-w-4/5 rounded-b-xl rounded-l-xl">
                        <div class="text-left text-sm text-gray-200 pr-10 pl-2 font-mon">`+data.message+`</div>
                        <p class="text-xs text-end mr-2 text-white">`+hours+":"+minutes+`</p>
                    </div>
                </div>`;
        }
        else{
            messageHtml=
            `<div class=" m-1 w-full h-fit flex message">
                <div class="bg-dark-blue ml-2 max-w-4/5 rounded-b-xl rounded-r-xl">
                    <div class="text-left text-sm text-gray-200 px-2 font-mon">`+data.message+`</div>
                    <p class="text-xs text-end mx-5 text-white">`+hours+":"+minutes+`</p>
                </div>
            </div>`;
        }
        $(".message").last().after(messageHtml);
        const elements = document.querySelectorAll(".message");
        const lastElement = elements[elements.length - 1];
        lastElement.scrollIntoView();

        
    });

    $("#form").submit(function (event) {
    event.preventDefault();
    if($("#content").val()==null || $("#content").val()==''|| $("#content").val()==' ')
    {
        return;
    }

    $.ajax({
      url:     "/group/{{$mainGroup->id}}/chat",
      method:  'POST',
      headers: {
        'X-Socket-Id': pusher.connection.socket_id
      },
      data:    {
        _token:  '{{csrf_token()}}',
        content: $("#content").val(),
      }
    }).done(function (res) {
    //   $(".messages > .message").last().after(res);
      $("#content").val('');
    //   $(document).scrollTop($(document).height());
        console.log(res);
    });
  });

</script>
<script>

    
    var elem = document.getElementById('{{$mainGroup->id}}');
    elem.scrollIntoView();

    // search functionality for groups
    let data={{ Js::from($groups) }};
    const groupInput=document.getElementById('group_search');
    groupInput.addEventListener('input',e=>{
        console.log(groupInput);
        const value=e.target.value.toLowerCase()
        data.forEach(user=>{
            // console.log(value);
            const isVisible=user.title.toLowerCase().includes(value)||user.company.toLowerCase().includes(value)
            document.getElementById(user.id).classList.toggle('hide',!isVisible);
            document.getElementById(user.id).classList.toggle('flex',isVisible);
        })
    })
    
    let data1={{ Js::from($members) }};
    const memberInput=document.getElementById('members_search');
    memberInput.addEventListener('input',e=>{
        const value=e.target.value.toLowerCase()
        data1.forEach(user=>{
            if(user.id=={{auth()->user()->id}}){ return;}
            const isVisible=user.name.toLowerCase().includes(value)
            document.getElementById('m'+user.id).classList.toggle('hide',!isVisible);
            document.getElementById('m'+user.id).classList.toggle('flex',isVisible);
        })
    })

    if(document.getElementById("error") != null){
        const whatever = document.getElementById("error").innerHTML;
        console.log(whatever);
          // nameInput.addEventListener("invalid", join);
          if(empt != null && empt != ""){
             // 
             setTimeout(showUpload(), 500);
          }
    }
    const elements = document.querySelectorAll(".message");
    const lastElement = elements[elements.length - 1];
    lastElement.scrollIntoView();

</script>
</html>