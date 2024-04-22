<!Doctype html>
<html>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="{{asset('img/logo.png')}}" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('group.css')}}">
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
      <header class="bg-white shadow-md text-black1 sticky top-0 left-0 w-full h-16 z-40">
         <div class="h-full" style="display: flex; left: 0; position: absolute; right: 0; justify-content: space-around;">
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
                     <img src="{{'storage/'.asset(auth()->user()->profile_url)}}" class="size-10 rounded-full ">
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
   {{-- //////////////////////end navbar /////////////////////////////: --}}


   {{-- /////////////////////////creat and join group//////////////////////////// --}}

   <main class="h-full w-full bg-no-repeat  overflow-y-hidden grid grid-cols-4 bg-right relative" id="main">
      <div class="fixed z-30 font-mon bg-red-50 grid hidden rounded-md shadow-md" id="deleteGroupModal" style="width: 400px; justify-items: center; align-content: space-evenly ;height: 200px; left: 50%; top:50%; transform: translate(-50%, -50%); tabindex="-1" aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
         <div class="grid justify-items-center">
            <svg fill="#eed202" height="60px" width="60px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 27.963 27.963" xml:space="preserve">
               <g>
                  <g id="c129_exclamation">
                     <path d="M13.983,0C6.261,0,0.001,6.259,0.001,13.979c0,7.724,6.26,13.984,13.982,13.984s13.98-6.261,13.98-13.984
                        C27.963,6.259,21.705,0,13.983,0z M13.983,26.531c-6.933,0-12.55-5.62-12.55-12.553c0-6.93,5.617-12.548,12.55-12.548
                        c6.931,0,12.549,5.618,12.549,12.548C26.531,20.911,20.913,26.531,13.983,26.531z"/>
                     <polygon points="15.579,17.158 16.191,4.579 11.804,4.579 12.414,17.158 		"/>
                     <path d="M13.998,18.546c-1.471,0-2.5,1.029-2.5,2.526c0,1.443,0.999,2.528,2.444,2.528h0.056c1.499,0,2.469-1.085,2.469-2.528
                        C16.441,19.575,15.468,18.546,13.998,18.546z"/>
                  </g>
                  <g id="Capa_1_207_">
                  </g>
               </g>
            </svg>
               <h5 class="font-semibold text-lg" id="deleteGroupModalLabel">Confirm Delete</h5>
         </div>
         <div class="text-sm text-gray-900">
               Are you sure you want to delete this group?
         </div>
         <div class="flex w-2/3 justify-around	">
               <button type="button" class="btn btn-secondary" onclick="hide();" data-bs-dismiss="modal">Close</button>
               <form method="POST" action="/group">  @csrf 
                  @method('DELETE')
                  <input type="hidden" name="group_id" id="deleteGroupId" value="">
                  <button type="submit" class="bg-red-500 text-white p-2 rounded-sm hover:scale-110 hover:bg-red-400">Delete</button>
               </form>
         </div>
      </div>
         <div class=" bg-white justify-center grid z-50 shadow-md shadow-gray-400 rounded-sm fixed opacity-0 " id="create"
            style="width: 700px; height: auto; left: 50%; top:50%; transform: translate(-50%, -50%); ">
            <button class="absolute right-3 top-1" onclick="annuler()">
               <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 48 48">
                  <path fill="#F44336" d="M21.5 4.5H26.501V43.5H21.5z" transform="rotate(45.001 24 24)"></path>
                  <path fill="#F44336" d="M21.5 4.5H26.5V43.501H21.5z" transform="rotate(135.008 24 24)"></path>
               </svg>
            </button>
            <p class="text-2xl ml-5 mt-3 font-medium">Create group</p>
            <form action="/group/creat" method="post" id="creatForm">
               @csrf
               <input name="title" type="text" placeholder="Group title"
                  class="m-5 mb-2 pl-5 bg-gray-100   rounded-b-none  outline-none rounded-lg  focus:border-b-2 focus:border-blue-600 focus:rounded-b-none hover:bg-gray-200"
                  style="width: 650px; height: 50px;">
               <input name="company" type="text" placeholder="University or Company name"
                  class="m-5 pl-5 bg-gray-100   rounded-b-none  outline-none rounded-lg focus:border-b-2 focus:border-blue-600 focus:rounded-b-none hover:bg-gray-300"
                  style="width: 650px; height: 50px;">
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
               <textarea name="description"
                  class=" h-48 mx-5 my-1  overflow-y-auto p-3 rounded-lg outline-none  focus:border-2  focus:border-laravel bg-gray-100  hover:bg-gray-200 "
                  maxlength="600" placeholder="Group info " style="width: 650px;"></textarea>
               <center>
                  <button class=" w-20 h-10 mb-2 rounded-lg  text-white bg-laravel  bottom-2" type="submit">create</button>
               </center>
            </form>
         </div>
         <div class=" bg-white justify-center translate-y-1/2 z-50 shadow-md shadow-gray-400 rounded-sm fixed opacity-0 "
            id="join" style="width: 600px; height: 270px;  left: 50%; top:50%; transform: translate(-50%, -50%);  ">
            <button class="absolute right-3 top-1" onclick="annuler()">
               <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 48 48">
                  <path fill="#F44336" d="M21.5 4.5H26.501V43.5H21.5z" transform="rotate(45.001 24 24)"></path>
                  <path fill="#F44336" d="M21.5 4.5H26.5V43.501H21.5z" transform="rotate(135.008 24 24)"></path>
               </svg>
            </button>
            <p class="text-2xl ml-5 mt-3 font-medium">Join Group</p>
            <label for="code" class="ml-6 pt-6">Enter the code of the group you want to join </label>
            <form accept="##" method="post">
               <input name="code" id="code" type="text" placeholder="Group code"
                  class="m-6 mb-2 pl-5 bg-gray-100 text-xl rounded-b-none border-black outline-none rounded-lg   focus:border-b-2 focus:border-laravel focus:rounded-b-none hover:bg-gray-200"
                  style="width: 550px; height: 70px;" autofocus>
               <button class="w-52 h-16 rounded-lg text-xl text-white bg-laravel absolute bottom-4 right-1/3 "
                  name="##">SEND</button>
            </form>
         </div>

      {{-- /////////////////////////groups component //////////////////////////// --}}
      @foreach ($groups as $index=>$group)
         @php
            $source="group_icons/".(($index)%12).".png";
            $color="bg-".(($index)%6);
            if ($group->leader->profile_url != NULL) {
               $profile="/storage/".$group->leader->profile_url;
            }
            else {
               $profile='profile.JPG';
            }
            // $profile=($group->leader->profile_url ?? 'profile.JPG');
         @endphp
         <div class=" res-width h-80  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
            <div class="w-full h-24 relative  bg-[url('{{asset($source)}}')] bg-150 bg-no-repeat bg-right">
               <div class="w-full h-24 absolute {{$color}} ">
                  <p class="text-white ml-4 drop-shadow leading-tight text-lg pt-2 font-medium">{{$group->title}} <br>
                  <p class="text-white ml-4 drop-shadow mt-6 absolute bottom-0">{{ $group->leader->name ?? 'No Leader Assigned' }}</p>
                  </p>
               </div>
               <img src="{{asset($profile)}}" class="size-16 rounded-full z-10 absolute bottom-0 right-1 translate-y-7">
            </div>
            <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 200px;">
               <p class=" ml-4 pt-1 h-fit text-gray-900 text-sm z-0">
                  <span class=" text-gray-400">{{$group->company}} </span>
                  <br>
                  {{$group->description}}
               </p>
            </div>
            @if (auth()->user()->id==$group->leader_id)
               {{-- <button>
                  <abbr title="Delet group">
                     <i class="absolute bottom-0 right-0 hover:scale-95 "style="color: #e52323;">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256" style="fill:#e52323;">
                        <g fill="#fa5252" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(4,4)"><path d="M28,7c-2.757,0 -5,2.243 -5,5v3h-10c-1.104,0 -2,0.896 -2,2c0,1.104 0.896,2 2,2h2.10938l1.68359,30.33203c0.178,3.178 2.80723,5.66797 5.99023,5.66797h18.43359c3.182,0 5.81223,-2.48997 5.99023,-5.66797l1.68359,-30.33203h2.10938c1.104,0 2,-0.896 2,-2c0,-1.104 -0.896,-2 -2,-2h-10v-3c0,-2.757 -2.243,-5 -5,-5zM28,11h8c0.552,0 1,0.449 1,1v3h-10v-3c0,-0.551 0.448,-1 1,-1zM19.11328,19h25.77344l-1.67383,30.10938c-0.059,1.06 -0.93509,1.89063 -1.99609,1.89063h-18.43359c-1.06,0 -1.93709,-0.82967 -1.99609,-1.88867zM32,23.25c-0.967,0 -1.75,0.784 -1.75,1.75v20c0,0.966 0.783,1.75 1.75,1.75c0.967,0 1.75,-0.784 1.75,-1.75v-20c0,-0.966 -0.783,-1.75 -1.75,-1.75zM24.64258,23.25195c-0.965,0.034 -1.7205,0.84259 -1.6875,1.80859l0.69727,20.08594c0.033,0.945 0.81005,1.68945 1.74805,1.68945c0.021,0 0.0415,0 0.0625,0c0.965,-0.034 1.7205,-0.84455 1.6875,-1.81055l-0.69727,-20.08594c-0.034,-0.965 -0.84655,-1.7105 -1.81055,-1.6875zM39.35547,23.25195c-0.967,-0.027 -1.77459,0.7225 -1.80859,1.6875l-0.69727,20.08594c-0.034,0.966 0.7215,1.77655 1.6875,1.81055c0.021,0.001 0.0415,0 0.0625,0c0.938,0 1.71505,-0.74445 1.74805,-1.68945l0.69727,-20.08594c0.034,-0.966 -0.72345,-1.77459 -1.68945,-1.80859z"></path></g></g>
                        </svg>
                     </i>
                  </abbr>
               </button>
               <button>
                  <abbr title="edit group">
                     <i class="absolute bottom-0 right-8 m-1 hover:scale-95 "style="color: #52fa52;">
                        <?xml version="1.0" ?>
                        <svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                           <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                           <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                     </i>
                  </abbr>
               </button> --}}
               <div class="dropdown">
                  <button class="dropdown-toggle" type="button" id="dropdownMenu{{ $group->id }}" data-groupId="{{ $group->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                     <?xml version="1.0" ?>
                     <svg class="icon icon-tabler icon-tabler-dots-vertical" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none" stroke="none"/>
                        <circle cx="12" cy="12" r="1"/>
                        <circle cx="12" cy="19" r="1"/>
                        <circle cx="12" cy="5" r="1"/>
                     </svg>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $group->id }}">
                     <li><a class="dropdown-item" href="/group/modify/{{$group->id}}">Modify</a></li>
                     <li id="deletbutton" onclick="showSign();"><a class="dropdown-item" href="#" data-group-id="{{ $group->id }}" data-bs-toggle="modal" data-bs-target="#deleteGroupModal">Delete</a></li>
                  </ul>
            </div>
            @else
               <button>
                  <i class="absolute bottom-0 right-0 hover:scale-95 "style="color: #fa5252;">
                     <svg class="h-8 w-8 text-black1-500 pointer" width="10" height="10" viewBox="0 0 28 28" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 12h14l-3 -3m0 6l3 -3" />
                     </svg>
                  </i>
               </button>
            @endif
         </div>
      @endforeach

      {{-- /////////////////////////// creat and join button //////////////////////: --}}
      <div class="fixed bottom-0 right-0 unclickable h-40 w-96">
         <button id="plus" onclick="list()" class="size-14 absolute bottom-6 rounded-full p-2  right-6 " style="background-color: #2ca0d9;color: #fff;"> 
            <i class="clickable">
               <?xml version="1.0" ?>
               <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                  <rect fill="none" height="200" width="200"/>
                  <line fill="none" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="35" x1="40" x2="216" y1="128" y2="128"/>
                  <line fill="none" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="35" x1="128" x2="128" y1="40" y2="216"/>
               </svg>
            </i>
         </button>
         <div class="w-52 h-28 absolute left-20 top-2 opacity-0 hidden shadow-md bg-green-50 border unclickable " id="select">
            <p id="join_button" class="w-52 h-12 text-xl text-gray-600  text-center pt-2 mt-2 border-b-2 border-gray-100 hover:bg-green-100 cursor-pointer"
               onclick="join()">Join Group</p>
            <p id="creat_button" class="w-52 h-12 text-xl text-gray-600  text-center pt-2 border-b-2  border-gray-100 hover:bg-green-100 cursor-pointer"
               onclick="create()">Create a Group</p>
         </div>
   </main>


   </body>
{{-- <script src="https://kit.fontawesome.com/71d0f31537.js" crossorigin="anonymous"></script> --}}
   <script src="{{asset('group.js')}}"></script>
</html>