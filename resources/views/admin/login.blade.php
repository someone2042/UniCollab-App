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
      <header class="bg-white shadow-md text-black1 fixed top-0 left-0 w-full h-16 z-40">
         <div class="h-full" style="display: flex; left: 0; position: absolute; right: 0; justify-content: space-around;">
            <a href="/home">
               <div class="flex-shrink-0 h-16 flex items-center pointer" style="position: absolute; left: 0;">
                  <img class="h-12 w-12" src="{{asset('img/logo.png')}}" alt="Logo">
                  <p class="font-mon font-bold text-2xl mx-5">UniCollab</p>
               </div>
            </a>
         </div>
      </header>
      <main>
        <div class="">
            <div
                class="bg-gray-100 border shadow-lg border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
            >
                <header class="text-center">
                    <h2 class="text-2xl font-bold mb-1">
                        Admin Login
                    </h2>
                    <p class="mb-4">log into Admin dashboard</p>
                </header>

                <form action="/admin/login" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="inline-block text-lg mb-2"
                            >Email</label
                        >
                        <input
                            type="email"
                            class="border border-gray-200 rounded p-2 w-full"
                            name="email"
                        />
                        @error('email')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label
                            for="password"
                            class="inline-block text-lg mb-2"
                        >
                            Password
                        </label>
                        <input
                            type="password"
                            class="border border-gray-200 rounded p-2 w-full"
                            name="password"
                        />
                    </div>

                    <div class="mb-6">
                        <button
                            type="submit"
                            class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                        >
                            Sign In
                        </button>
                    </div>

                    {{-- <div class="mt-8">
                        <p>
                            Don't have an account?
                            <a href="register.html" class="text-laravel"
                                >Register</a
                            >
                        </p>
                    </div> --}}
                </form>
            </div>
        </div>
    </main>
   </body>
</html>