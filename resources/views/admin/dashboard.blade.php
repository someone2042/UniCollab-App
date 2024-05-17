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
                   color1: "#4154f1",
                   color2: "#ee6c20",
                   color3: "#15be56",
                   color4: "#bb0852",
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
                        <a class="size-10 rounded-full" href="/admin/profile">
                           <svg class="h-9 w-9 text-black1-500 pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                           </svg>
                        </a>
                  </li>
               </a>
               <li class="mt-1">
                <a href="/admin/logout">
                    <svg class="h-9 w-9 text-black1-500 pointer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 12h14l-3 -3m0 6l3 -3" />
                    </svg>
                </a>
               </li>
            </ul>
         </div>
      </header>
   {{-- //////////////////////end navbar /////////////////////////////: --}}


   {{-- /////////////////////////creat and join group//////////////////////////// --}}
      <style>
        .h-lot{
            height: 450px;
        }
      </style>
   <main class="grid w-full justify-items-center">
        <div class="w-full h-28 my-10 px-7">
            <div class="flex w-full h-full">
                <div class="w-full mx-1 rounded bg-color1 relative" >
                    <p class="font-mon text-lg text-white font-semibold p-2">Users</p>
                    <p class="font-mon text-4xl text-white font-medium p-2">{{$userscount}}</p>
                    <div class="h-full absolute right-0 flex justify-items-center aspect-square bottom-0">
                        <svg width="100px" height="100px" id="user">
                            <path fill='#FFF' d="M59.3 52.2C65.8 48.2 70 40.3 70 33c0-10.4-8.5-22-20-22S30 22.6 30 33c0 7.3 4.2 15.2 10.7 19.2C25.3 56.3 14 70.4 14 87c0 1.1.9 2 2 2h68c1.1 0 2-.9 2-2 0-16.6-11.3-30.7-26.7-34.8zM34 33c0-10.3 8.5-18 16-18s16 7.7 16 18-8.5 18-16 18-16-7.7-16-18zM18.1 85c1-16.7 15-30 31.9-30s30.9 13.3 31.9 30H18.1z"></path>
                            <path fill='#FFF' d="M1224-790V894H-560V-790h1784m8-8H-568V902h1800V-798z"></path>
                        </svg>
                    </div>
                </div>
                <div class="w-full mx-1 rounded bg-color2 relative" >
                    <p class="font-mon text-lg text-white font-semibold p-2">Groups</p>
                    <p class="font-mon text-4xl text-white font-medium p-2">{{$groupscount}}</p>
                    <div class="h-full absolute right-0 flex justify-items-center aspect-square bottom-0">
                        <svg width="100px" height="100px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#FFF" fill="none">
                            <circle cx="22.83" cy="22.57" r="7.51"/>
                            <path d="M38,49.94a15.2,15.2,0,0,0-15.21-15.2h0a15.2,15.2,0,0,0-15.2,15.2Z"/>
                            <circle cx="44.13" cy="27.22" r="6.05"/>
                            <path d="M42.4,49.94h14A12.24,12.24,0,0,0,44.13,37.7h0a12.21,12.21,0,0,0-5.75,1.43"/>
                        </svg>
                    </div>
                </div>
                <div class="w-full mx-1 rounded bg-color3 relative" >
                    <p class="font-mon text-lg text-white font-semibold p-2">Projects</p>
                    <p class="font-mon text-4xl text-white font-medium p-2">{{$projects}} </p>
                    <div class="h-full absolute right-0 flex justify-items-center aspect-square bottom-0">
                        <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.5 6C6.5 5.17157 7.17157 4.5 8 4.5H13.5L17.5 8.5V18C17.5 18.8284 16.8284 19.5 16 19.5H8C7.17157 19.5 6.5 18.8284 6.5 18V6Z" stroke="#FFF"/>
                            <path d="M13 4.5V9H17.5" stroke="#FFF" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="w-full mx-1 rounded bg-color4 relative" >
                    <p class="font-mon text-lg text-white font-semibold p-2">Message</p>
                    <p class="font-mon text-4xl text-white font-medium p-2">{{$messages}} </p>
                    <div class="h-full absolute right-0 flex justify-items-center aspect-square bottom-0">
                        <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.5 11.5H15.51M11.5 11.5H11.51M7.5 11.5H7.51M15.6953 19.2318L19.1027 20.3676C19.8845 20.6282 20.6282 19.8844 20.3676 19.1027L19.2318 15.6953M15.3 19.1C15.3 19.1 14.0847 20 11.5 20C6.80558 20 3 16.1944 3 11.5C3 6.80558 6.80558 3 11.5 3C16.1944 3 20 6.80558 20 11.5C20 14 19.1 15.3 19.1 15.3" stroke="#FFF" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
        <p class="text-2xl w-4/5 m-3 pl-6 underline underline-offset-4">#Users</p>
        <div class="w-4/5 h-lot mb-10 overflow-auto">
            <table class="border-collapse border border-slate-500 w-full">
                <thead>
                  <tr>
                    <th class="border border-slate-600 p-2 font-mon">Id</th>
                    <th class="border border-slate-600 p-2 font-mon">Profile</th>
                    <th class="border border-slate-600 p-2 font-mon">Name</th>
                    <th class="border border-slate-600 p-2 font-mon">Email</th>
                    <th class="border border-slate-600 p-2 font-mon">Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @php
                            if ($user->profile_url != NULL) {
                                $profile="/storage/".$user->profile_url;
                            }
                            else {
                                $profile='profile.JPG';
                            }
                        @endphp
                        <tr>
                            <td class="border border-slate-700 p-2 font-mon w-16 text-center">#{{$user->id}}</td>
                            <td class="border border-slate-700 p-2 h-20 w-20 font-mon"><img src="{{asset($profile)}}" alt=""></td>
                            <td class="border border-slate-700 p-2 font-mon">{{$user->name}} </td>
                            <td class="border border-slate-700 p-2 font-mon">{{$user->email}} </td>
                            <td class="border border-slate-700 p-2 font-mon min-w-20"><a href="/admin/user/remove/{{$user->id}}"><button class=" bg-red-600 w-full h-8 rounded-md font-mon hover:scale-95 font-medium hover:bg-red-500 text-white">Delete</button></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="text-2xl w-11/12 m-3 pl-6 underline underline-offset-4">#Groups</p>
        <div class="w-11/12 h-lot mb-10 overflow-auto">
            <table class="border-collapse border border-slate-500 w-full">
                <thead>
                  <tr>
                    <th class="border border-slate-600 p-2 font-mon">Id</th>
                    <th class="border border-slate-600 p-2 font-mon">Title</th>
                    <th class="border border-slate-600 p-2 font-mon">Leader</th>
                    <th class="border border-slate-600 p-2 font-mon">Code</th>
                    <th class="border border-slate-600 p-2 font-mon">Organization</th>
                    <th class="border border-slate-600 p-2 font-mon">type</th>
                    <th class="border border-slate-600 p-2 font-mon">Description</th>
                    <th class="border border-slate-600 p-2 font-mon">Members</th>
                    <th class="border border-slate-600 p-2 font-mon">Remove</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td class="border border-slate-700 p-2 font-mon w-10 text-center">#{{$group->id}}</td>
                            <td class="border border-slate-700 p-2 font-mon">{{$group->title}} </td>
                            <td class="border border-slate-700 p-2 font-mon">{{$group->leader->name}} </td>
                            <td class="border border-slate-700 p-2 font-mon">{{$group->code}} </td>
                            <td class="border border-slate-700 p-2 font-mon">{{$group->company}} </td>
                            <td class="border border-slate-700 p-2 font-mon">{{$group->type}} </td>
                            <td class="border border-slate-700 p-2 font-mon">{{$group->description}} </td>
                            <td class="border border-slate-700 font-mon">
                                <ul class="list-disc pl-4">
                                    @foreach ($group->members as $member)
                                        <li>{{$member->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="border border-slate-700 p-2 font-mon"><a href="/admin/group/remove/{{$group->id}}"><button class=" bg-red-600 w-full h-8 rounded-md font-mon hover:scale-95 font-medium hover:bg-red-500 text-white">Delete</button></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   </main>

   </body>
{{-- <script src="https://kit.fontawesome.com/71d0f31537.js" crossorigin="anonymous"></script> --}}
</html>