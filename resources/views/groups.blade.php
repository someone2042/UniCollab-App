<!Doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('group.css') }}">
    <title>UniCollab home</title>

</head>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    laravel: "#1967D2",
                    laravel2: "#7ab4cc",
                },
            },
        },
    };
</script>

<body class="relative h-full w-full">
    {{-- flash message --}}
    <x-flash-message />
    {{-- @php
         dd($groups)
      @endphp --}}

    {{-- navbar --}}
    <header class="sticky left-0 top-0 z-40 h-16 w-full bg-white text-black1 shadow-md">
        <div class="h-full"
            style="display: flex; left: 0; position: absolute; right: 0; justify-content: space-around;">
            <a href="/home">
                <div class="pointer flex h-16 flex-shrink-0 items-center" style="position: absolute; left: 0;">
                    <img class="h-12 w-12" src="{{ asset('img/logo.png') }}" alt="Logo">
                    <p class="mx-5 font-mon text-2xl font-bold">UniCollab</p>
                </div>
            </a>
            <ul class="flex h-full items-center space-x-4 pr-5" style=" position: absolute; right: 0;">
                <a href="/profile">
                    <li>
                        @if (auth()->user()->profile_url != null)
                            <img src="{{ 'storage/' . asset(auth()->user()->profile_url) }}"
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
    {{-- //////////////////////end navbar /////////////////////////////: --}}


    {{-- /////////////////////////creat and join group//////////////////////////// --}}

    <main class="relative grid h-full w-full grid-cols-4 overflow-y-hidden bg-right bg-no-repeat" id="main">
        <div class="fixed z-30 grid hidden rounded-md bg-red-50 font-mon shadow-md" id="deleteGroupModal"
            style="width: 400px; justify-items: center; align-content: space-evenly ;height: 200px; left: 50%; top:50%; transform: translate(-50%, -50%); tabindex="-1"
            aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
            <div class="grid justify-items-center">
                <svg fill="#eed202" height="60px" width="60px" version="1.1" id="Capa_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 27.963 27.963" xml:space="preserve">
                    <g>
                        <g id="c129_exclamation">
                            <path d="M13.983,0C6.261,0,0.001,6.259,0.001,13.979c0,7.724,6.26,13.984,13.982,13.984s13.98-6.261,13.98-13.984
                        C27.963,6.259,21.705,0,13.983,0z M13.983,26.531c-6.933,0-12.55-5.62-12.55-12.553c0-6.93,5.617-12.548,12.55-12.548
                        c6.931,0,12.549,5.618,12.549,12.548C26.531,20.911,20.913,26.531,13.983,26.531z" />
                            <polygon points="15.579,17.158 16.191,4.579 11.804,4.579 12.414,17.158 		" />
                            <path d="M13.998,18.546c-1.471,0-2.5,1.029-2.5,2.526c0,1.443,0.999,2.528,2.444,2.528h0.056c1.499,0,2.469-1.085,2.469-2.528
                        C16.441,19.575,15.468,18.546,13.998,18.546z" />
                        </g>
                        <g id="Capa_1_207_">
                        </g>
                    </g>
                </svg>
                <h5 class="text-lg font-semibold" id="deleteGroupModalLabel">Confirm Delete</h5>
            </div>
            <div class="text-sm text-gray-900">
                Are you sure you want to delete this group?
            </div>
            <div class="flex w-2/3 justify-around">
                <button type="button" class="btn btn-secondary" onclick="hide();"
                    data-bs-dismiss="modal">Close</button>
                <form method="POST" action="/group"> @csrf
                    @method('DELETE')
                    <input type="hidden" name="group_id" id="deleteGroupId" value="">
                    <button type="submit"
                        class="rounded-sm bg-red-500 p-2 text-white hover:scale-110 hover:bg-red-400">Delete</button>
                </form>
            </div>
        </div>
        <div class="fixed z-50 grid justify-center rounded-sm bg-white opacity-0 shadow-md shadow-gray-400"
            id="create" style="width: 700px; height: auto; left: 50%; top:50%; transform: translate(-50%, -50%); ">
            <p class="ml-5 mt-3 text-2xl font-medium">Create group</p>
            <form action="/group/creat" method="post" id="creatForm">
                @csrf
                <input name="title" type="text" placeholder="Group title"
                    class="m-5 mb-2 rounded-lg rounded-b-none bg-gray-100 pl-5 outline-none hover:bg-gray-200 focus:rounded-b-none focus:border-b-2 focus:border-blue-600"
                    style="width: 650px; height: 50px;">
                @error('title')
                    <p class="test-xs mt-1 text-red-500">{{ $message }}</p>
                @enderror
                <input name="company" type="text" placeholder="University or Company name"
                    class="m-5 rounded-lg rounded-b-none bg-gray-100 pl-5 outline-none hover:bg-gray-300 focus:rounded-b-none focus:border-b-2 focus:border-blue-600"
                    style="width: 650px; height: 50px;">
                @error('company')
                    <p class="test-xs mt-1 text-red-500">{{ $message }}</p>
                @enderror
                <div class="mb-3 ml-5 mr-6 flex">
                    <div class="relative flex h-8 w-full rounded-md bg-gray-300">
                        <input type="radio" id="private" name="type" value="private" checked="checked"
                            class="appearance-none" />
                        <label for="private"
                            class="py z-10 flex w-1/2 cursor-pointer select-none items-center justify-center truncate rounded-full font-semibold uppercase">Private
                            group</label>

                        <input type="radio" id="public" name="type" value="public"
                            class="appearance-none" />
                        <label for="public"
                            class="py z-10 flex w-1/2 cursor-pointer select-none items-center justify-center truncate rounded-full font-semibold uppercase">Public
                            group</label>

                        <div
                            class="bg-laravel2 tabAnim absolute flex h-full w-1/2 transform select-none items-center justify-center truncate rounded-md p-2 text-lg font-semibold uppercase transition-transform">
                        </div>
                    </div>
                </div>
                <textarea name="description"
                    class="focus:border-laravel mx-5 my-1 h-48 overflow-y-auto rounded-lg bg-gray-100 p-3 outline-none hover:bg-gray-200 focus:border-2"
                    maxlength="600" placeholder="Group info " style="width: 650px;"></textarea>
                @error('company')
                    <p class="test-xs mt-1 text-red-500">{{ $message }}</p>
                @enderror
                <center>
                    <button class="bg-laravel bottom-2 mb-2 h-10 w-20 rounded-lg text-white"
                        type="submit">create</button>
                </center>
            </form>
        </div>
        <div class="fixed z-50 translate-y-1/2 justify-center rounded-sm bg-white opacity-0 shadow-md shadow-gray-400"
            id="join"
            style="width: 600px; height: 300px;  left: 50%; top:50%; transform: translate(-50%, -50%);  ">

            <p class="ml-5 mt-3 text-2xl font-medium">Join Group</p>
            <label for="code" class="ml-6 pt-6">Enter the code of the group you want to join </label>
            <form method="post" action="/group/join">
                @csrf
                <input name="code" id="code" type="text" placeholder="Group code"
                    class="focus:border-laravel m-6 mb-2 rounded-lg rounded-b-none border-black bg-gray-100 pl-5 text-xl outline-none hover:bg-gray-200 focus:rounded-b-none focus:border-b-2"
                    style="width: 550px; height: 70px;" autofocus>
                @error('code')
                    <p class="test-xs m-2 mt-1 text-center text-red-500" id="error">{{ $message }}</p>
                @enderror
                <center>
                    <button class="bg-laravel absolute bottom-4 right-1/3 h-16 w-52 rounded-lg text-xl text-white"
                        type="submit">Join</button>
                </center>
            </form>

        </div>

        {{-- /////////////////////////groups component //////////////////////////// --}}
        @unless (count($groups) == 0)

            @foreach ($groups as $index => $group)
                @php
                    $source = 'group_icons/' . $index % 12 . '.png';
                    $color = 'bg-' . $index % 6;
                    if ($group->leader->profile_url != null) {
                        $profile = '/storage/' . $group->leader->profile_url;
                    } else {
                        $profile = 'profile.JPG';
                    }
                    // $profile=($group->leader->profile_url ?? 'profile.JPG');
                @endphp
                <div
                    class="res-width group_p relative mb-1 ml-5 mt-4 h-80 rounded-md bg-gray-50 shadow-md shadow-gray-300">
                    <a href="/group/{{ $group->id }}">
                        <div class="bg-150 relative h-24 w-full bg-[url('{{ asset($source) }}')] bg-right bg-no-repeat">
                            <div class="{{ $color }} absolute h-24 w-full">
                                <p class="ml-4 pt-2 text-lg font-medium leading-tight text-white drop-shadow">
                                    {{ $group->title }} <br>
                                <p class="absolute bottom-0 ml-4 mt-6 text-white drop-shadow">
                                    {{ $group->leader->name ?? 'No Leader Assigned' }}</p>
                                </p>
                            </div>
                            <img src="{{ asset($profile) }}"
                                class="size-16 absolute bottom-0 right-1 z-10 translate-y-7 rounded-full">
                        </div>
                        <div class="relative w-full overflow-y-auto bg-transparent" style="max-height: 200px;">
                            <p class="z-0 ml-4 h-fit pt-1 text-sm text-gray-900">
                                <span class="text-gray-400">{{ $group->company }} </span>
                                <br>
                                {{ $group->description }}
                            </p>
                        </div>
                    </a>
                    @if (auth()->user()->id == $group->leader_id)
                        <div class="dropdown">
                            <button class="dropdown-toggle" type="button" id="dropdownMenu{{ $group->id }}"
                                data-groupId="{{ $group->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <?xml version="1.0" ?>
                                <svg class="icon icon-tabler icon-tabler-dots-vertical" fill="none" height="24"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none" stroke="none" />
                                    <circle cx="12" cy="12" r="1" />
                                    <circle cx="12" cy="19" r="1" />
                                    <circle cx="12" cy="5" r="1" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $group->id }}">
                                <li><a class="dropdown-item" href="/group/{{ $group->id }}/modify">Modify</a></li>
                                <li id="deletbutton" onclick="showSign();"><a class="dropdown-item" href="#"
                                        data-group-id="{{ $group->id }}" data-bs-toggle="modal"
                                        data-bs-target="#deleteGroupModal">Delete</a></li>
                            </ul>
                        </div>
                    @else
                        <form action="/group/{{ $group->id }}/leave" method="post">
                            @csrf
                            <button type="submit">
                                <i class="absolute bottom-0 right-0 hover:scale-95"style="color: #fa5252;">
                                    <svg class="text-black1-500 pointer h-8 w-8" width="10" height="10"
                                        viewBox="0 0 28 28" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <path
                                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                        <path d="M7 12h14l-3 -3m0 6l3 -3" />
                                    </svg>
                                </i>
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        @else
            <p class="fixed bottom-1/2 w-full text-center text-5xl text-gray-300">No Group yet</p>
        @endunless

        {{-- /////////////////////////// creat and join button //////////////////////: --}}
        <div class="unclickable fixed bottom-0 right-0 h-40 w-96">
            <button id="plus" onclick="list()" class="size-14 absolute bottom-6 right-6 rounded-full p-2"
                style="background-color: #2ca0d9;color: #fff;">
                <i class="clickable">
                    <?xml version="1.0" ?>
                    <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                        <rect fill="none" height="200" width="200" />
                        <line fill="none" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="35" x1="40" x2="216" y1="128" y2="128" />
                        <line fill="none" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="35" x1="128" x2="128" y1="40" y2="216" />
                    </svg>
                </i>
            </button>
            <div class="unclickable absolute left-20 top-2 hidden h-28 w-52 border bg-green-50 opacity-0 shadow-md"
                id="select">
                <p id="join_button"
                    class="mt-2 h-12 w-52 cursor-pointer border-b-2 border-gray-100 pt-2 text-center text-xl text-gray-600 hover:bg-green-100"
                    onclick="join()">Join Group</p>
                <p id="creat_button"
                    class="h-12 w-52 cursor-pointer border-b-2 border-gray-100 pt-2 text-center text-xl text-gray-600 hover:bg-green-100"
                    onclick="create()">Create a Group</p>
            </div>
    </main>

</body>
{{-- <script src="https://kit.fontawesome.com/71d0f31537.js" crossorigin="anonymous"></script> --}}
<script src="{{ asset('group.js') }}"></script>
<script>
    const empt = document.getElementById("error").innerHTML;
    // nameInput.addEventListener("invalid", join);
    if (empt != null && empt != "") {
        // 
        setTimeout(join(), 500);
    }
</script>

</html>
