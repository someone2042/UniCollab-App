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
                        <a class="size-10 rounded-full" href="/profile">
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

   <main>
        <h2>dashboard</h2>
   </main>

   </body>
{{-- <script src="https://kit.fontawesome.com/71d0f31537.js" crossorigin="anonymous"></script> --}}
   <script src="{{asset('group.js')}}"></script>
   <script>
      const empt = document.getElementById("error").innerHTML;
      // nameInput.addEventListener("invalid", join);
      if(empt != null && empt != ""){
         // 
         setTimeout(join(), 500);
      }
   </script>
</html>