<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('img/logo.png')}}" rel="icon">

    <script src="https://cdn.tailwindcss.com"></script>
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
    <title>UniCollab Profile</title>
</head>
<style>
    body {
        background-color: #d7e5fa;
    }
    
    .tabAnim {
    z-index: 1;
    }

    #private:checked~div {
        --tw-translate-x: 0%;
    }

    #public:checked~div {
        --tw-translate-x: 100%;
    }
</style>

<body class="mb-48">
    <header class="bg-white shadow-md text-black1 sticky top-0 left-0 w-full h-16 z-40">
        <div class="h-full"
            style="display: flex; left: 0; position: absolute; right: 0; justify-content: space-around;">
            <a href="/home">
                <div class="flex-shrink-0 h-16 flex items-center pointer" style="position: absolute; left: 0;">
                    <img class="h-12 w-12" src="{{asset('img/logo.png')}}" alt="Logo">
                    <p class="font-mon font-bold text-2xl mx-5">UniCollab</p>
                </div>
            </a>
            <ul class="flex space-x-4 pr-5 h-full items-center	" style=" position: absolute; right: 0;">
                <a href="/profile">
                    <li>
                        @if (auth()->user()->profile_url!=NULL)
                        <img src="{{'/storage'.asset(auth()->user()->profile_url)}}" class="size-10 rounded-full ">
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
                            <svg class="h-9 w-9 text-black1-500 pointer" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
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
    @php
        // dd($group->title);
    @endphp

    <main>
        <div class="mx-4">
            <div class="bg-gray-50 border border-gray-200 shadow-md p-10 rounded max-w-lg mx-auto mt-24">
                <header class="text-center">
                    <h2 class="text-3xl font-bold uppercase mb-1">
                        Edit Group
                    </h2>
                    <h4>Group code</h4>
                    <p class="text-laravel text-xl mb-4">
                        {{$group->code}}
                    </p>
                </header>

                <form action="/group/{{$group->id}}/modify" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="title" class="inline-block text-lg mb-2">Groupe Title </label>
                        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                            placeholder="title" value="{{old('title') ?? $group->title}}" />
                        @error('title')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror                    
                    </div>
                    
                    <div class="mb-6">
                        <label for="company" class="inline-block text-lg mb-2">University or Company </label>
                        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company"
                            placeholder="University or Company" value="{{old('company') ?? $group->company}}" />
                        @error('company')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror                    
                    </div>
                    <div class="flex mb-3 ml-5 mr-6  ">
                        <div class="flex w-full relative bg-gray-300 h-8 rounded-md">
                           <input type="radio" id="private" name="type" value="private" checked="checked" class="appearance-none" />
                           <label for="private"
                              class="cursor-pointer w-1/2 flex items-center justify-center truncate z-10 uppercase select-none font-semibold rounded-full py">Private
                              group</label>
      
                           <input type="radio" id="public" name="type" value="public" class="appearance-none" />
                           <label for="public"
                              class="cursor-pointer w-1/2 flex items-center justify-center truncate z-10 uppercase select-none font-semibold  rounded-full py">Public
                              group</label>
      
                           <div
                              class="w-1/2  flex items-center justify-center truncate uppercase select-none font-semibold text-lg rounded-md p-2 h-full bg-laravel absolute transform transition-transform tabAnim">
                           </div>
                        </div>
                     </div>
                    <div class="mb-6">
                        <label for="tite" class="inline-block text-lg mb-2">Group description </label>
                        <textarea name="description" id="" class="border border-gray-200 rounded p-2 w-full h-52" placeholder="description">{{old('description') ?? $group->description}}</textarea>
                        @error('description')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror                    
                    </div>

                    <div class="mb-6">
                        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-laravel2 text-lg">
                            Edit Group
                        </button>

                        <a href="/home" class="text-black ml-4">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>