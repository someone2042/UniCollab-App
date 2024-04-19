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
    <title>LaraGigs | Find Laravel Jobs & Projects</title>
</head>
<style>
    body {
        background-color: #d7e5fa;
    }

    .profile-pic {
        border-radius: 50%;
        height: 150px;
        width: 150px;
        background-size: cover;
        background-position: center;
        background-blend-mode: multiply;
        vertical-align: middle;
        text-align: center;
        color: transparent;
        transition: all .3s ease;
        text-decoration: none;
        cursor: pointer;
    }

    .profile-pic:hover {
        background-color: rgba(0, 0, 0, .5);
        z-index: 10000;
        color: #fff;
        transition: all .3s ease;
        text-decoration: none;
    }

    .profile-pic span {
        display: inline-block;
        padding-top: 4.5em;
        padding-bottom: 4.5em;
    }

    form input[type="file"] {
        display: none;
        cursor: pointer;
    }
</style>

<body class="mb-48">
    <header class="bg-white shadow-md text-black1 sticky top-0 left-0 w-full h-16 z-40">
        <div class="h-full"
            style="display: flex; left: 0; position: absolute; right: 0; justify-content: space-around;">
            <a href="/groups">
                <div class="flex-shrink-0 h-16 flex items-center pointer" style="position: absolute; left: 0;">
                    <img class="h-12 w-12" src="{{asset('img/logo.png')}}" alt="Logo">
                    <p class="font-mon font-bold text-2xl mx-5">UniCollab</p>
                </div>
            </a>
            <ul class="flex space-x-4 pr-5 h-full items-center	" style=" position: absolute; right: 0;">
                <li>
                    @if (auth()->user()->profile_url!=NULL)
                        <img src="{{asset(auth()->user()->profile_url)}}" class="size-10 rounded-full ">
                    @else
                    <a class="size-10 rounded-full">
                        <svg class="h-9 w-9 text-black1-500 pointer" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                    @endif
                </li>
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

    <main>
        <div class="mx-4">
            <div class="bg-gray-50 border border-gray-200 shadow-md p-10 rounded max-w-lg mx-auto mt-24">
                <header class="text-center">
                    <h2 class="text-2xl font-bold uppercase mb-1">
                        Edit Profile
                    </h2>
                </header>

                <form action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <center>
                            <label for="fileToUpload">
                                <div class="profile-pic" id="photo" style="background-image: url('per.JPG')">
                                    <!-- <span class="glyphicon glyphicon-camera"></span> -->
                                    <span>Change Image</span>
                                </div>
                            </label>
                        </center>
                    </div>
                    <input type="File" name="fileToUpload" accept="image/png, image/gif, image/jpeg" id="fileToUpload">

                    <div class="mb-6">
                        <label for="name" class="inline-block text-lg mb-2">Name</label>
                        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                            placeholder="name" />
                    </div>

                    <div class="mb-6">
                        <label for="title" class="inline-block text-lg mb-2">Job Title</label>
                        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                            placeholder="Example: Senior Laravel Developer" />
                    </div>

                    <div class="mb-6">
                        <label for="email" class="inline-block text-lg mb-2">email</label>
                        <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                            placeholder="email@email.com" />
                    </div>

                    <div class="mb-6">
                        <label for="password" class="inline-block text-lg mb-2">
                            password
                        </label>
                        <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"
                            placeholder="password" />
                    </div>
                    <div class="mb-6">
                        <label for="password_confirmation" class="inline-block text-lg mb-2">
                            password confirmation
                        </label>
                        <input type="password" class="border border-gray-200 rounded p-2 w-full"
                            name="password_confirmation" placeholder="confirm your password" />
                    </div>

                    <div class="mb-6">
                        <label for="logo" class="inline-block text-lg mb-2">
                            Company Logo
                        </label>
                        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />
                    </div>

                    <div class="mb-6">
                        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-laravel2 text-lg">
                            Edit Profile
                        </button>

                        <a href="dashboard.html" class="text-black ml-4">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    const img = document.querySelector('#photo');
    const file = document.querySelector('#fileToUpload');
    file.addEventListener('change', function () {
        const choosedFile = this.files[0];

        if (choosedFile) {

            const reader = new FileReader();

            reader.addEventListener('load', function () {
                img.setAttribute('src', reader.result);
                img.setAttribute('style', "background-image: url('" + reader.result + "')");
            });

            reader.readAsDataURL(choosedFile);

        }
    });
</script>

</html>