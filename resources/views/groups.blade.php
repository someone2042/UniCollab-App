<!Doctype html>
<html>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <link href="./output.css" rel="stylesheet"> -->
   <style>
      .colore {
         color: #e52323;
      }
   </style>
   <script src="https://cdn.tailwindcss.com"></script>
   <title>project pfe</title>
   <style>
      /* #chat {
        height:583px;
    }
    #Groupe {  
      height:540px;
    }
    #collegue {
      height:575px;
    } */

      ::-webkit-scrollbar {
         width: 7px;
         border-radius: 10px;

      }

      /* Track */
      ::-webkit-scrollbar-track {
         background-color: #97c5d9;
         box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
         border-radius: 10px;
      }

      /* Handle */
      ::-webkit-scrollbar-thumb {
         background: #1967D2;
         border-radius: 10px;
      }

      body {

         /* background: linear-gradient(190deg , rgba(222, 233, 234, 0.943) ,rgba(255, 255, 255) ); */
         height: 816px;
         background: white;
      }

      header {
         height: 88px;
      }

      h1 {

         -webkit-text-stroke: 0.1Vw #28857b;
         color: transparent;
         text-shadow: 0 0 40px #d29d2b;

      }

      #select,
      #create,
      #join {
         /* animation: rotat 2s ease 2 ; */
         transition: 0.5s ease;

      }

      /* @keyframes rotat {
      100%{
         transform: rotateY(0deg);
      }
      25%{
         transform: rotateY(90deg); 
      }
      50%{
         transform: rotateY(180deg); 
      }
      75%{
         transform: rotateY(300deg); 
      }
      95%{
         transform: rotateY(360deg); 
      }
      
    } */

      @media (max-width:1200px) {
         #main {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
         }

         .res-width {
            width: 90%;
         }
      }

      @media (max-width:900px) {
         #main {
            display: grid;
            grid-template-columns: 1fr 1fr;
         }
      }

      @media (max-width:500px) {
         #main {

            display: grid;
            grid-template-columns: 1fr;
         }
      }

      @media (max-height:460px) {
         #main {
            display: grid;
            grid-template-rows: 1fr;
         }

      }
   </style>
</head>

<body class="relative h-full w-full">
   <x-flash-message />
   <header class="bg-white shadow-md text-black1 sticky top-0 left-0 w-full h-16 z-40">
      <div class="" style="display: flex; left: 0; position: absolute; right: 0; justify-content: space-around;">
         <div class="flex-shrink-0 h-16 flex items-center pointer" style="position: absolute; left: 0;">
            <img class="h-12 w-12" src="logo2.png" alt="Logo">
            <p class="font-mon font-semibold text-2xl mx-5">UniCollab</p>
         </div>
         <ul class="flex space-x-4 pr-5 m-4" style=" position: absolute; right: 0; margin: 16px;">
            <li><a href="#" class=""><svg class="h-8 w-8 text-black1-500 pointer" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg></a>
            </li>
            @auth
                <li>
                  welcome {{auth()->user()->name}}
                </li>
            @endauth
            <li>
               <form action="/logout" method="POST">
                  @csrf
                  <button type="submit">
                     <a href="#" class=""></a><svg class="h-8 w-8 text-black1-500 pointer" width="24" height="24"
                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                     stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" />
                     <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                     <path d="M7 12h14l-3 -3m0 6l3 -3" />
                     </svg>
                  </button>
               </form>
               {{-- <form action="/logout" method="POST">
                  @csrf
                  <button type="submit">Logout</button>
              </form> --}}
            </li>
         </ul>
      </div>
   </header>


   <!-- ///////////////c'est le one des groupes////////////// -->
   <style>
      .bg-150 {
         background-size: 150px;
      }

      .bg-1 {
         background-color: #2db6fa;
      }

      .bg-2 {
         background-color: #f68c09;
      }

      .bg-3 {
         background-color: #08da4e;
      }

      .bg-4 {
         background-color: #e9222c;
      }

      .bg-5 {
         background-color: #b50edf;
      }

      .bg-6 {
         background-color: #f51f9c;
      }
   </style>
   <main
      class="h-full w-full bg-[url('acceuil3.jpg')] bg-no-repeat  overflow-y-hidden grid grid-cols-4 bg-right relative"
      id="main">
      <div class=" bg-white justify-center grid z-50 shadow-md shadow-gray-400 rounded-sm fixed opacity-0 " id="create"
         style="width: 700px; height: auto; left: 50%; top:50%; transform: translate(-50%, -50%); ">
         <button class="absolute right-3 top-1" onclick="annuler()"><i class="fa-solid fa-xmark fa-xl "
               style="color: rgb(173, 14, 14);"></i></button>
         <p class="text-2xl ml-5 mt-3 font-medium">Create group</p>
         <form accept="##" method="post">
            <input name="n_group" type="text" placeholder="Group title"
               class="m-5 mb-2 pl-5 bg-gray-100   rounded-b-none  outline-none rounded-lg  focus:border-b-2 focus:border-blue-600 focus:rounded-b-none hover:bg-gray-200"
               style="width: 650px; height: 50px;">
            <input name="univ" type="text" placeholder="University or Company name"
               class="m-5 pl-5 bg-gray-100   rounded-b-none  outline-none rounded-lg focus:border-b-2 focus:border-blue-600 focus:rounded-b-none hover:bg-gray-300"
               style="width: 650px; height: 50px;">
            <div class="flex mb-3 ml-5 mr-6  ">
               <div class="flex w-full relative bg-gray-300 h-8 rounded-md">
                  <input type="radio" id="option0" name="tabs" class="appearance-none" />
                  <label for="option0"
                     class="cursor-pointer w-1/2 flex items-center justify-center truncate z-10 uppercase select-none font-semibold rounded-full py">Private
                     group</label>

                  <input type="radio" id="option1" name="tabs" class="appearance-none" />
                  <label for="option1"
                     class="cursor-pointer w-1/2 flex items-center justify-center truncate z-10 uppercase select-none font-semibold  rounded-full py">Public
                     group</label>

                  <div
                     class="w-1/2  flex items-center justify-center truncate uppercase select-none font-semibold text-lg rounded-md p-2 h-full bg-indigo-600 absolute transform transition-transform tabAnim">
                  </div>
               </div>
            </div>
            <textarea name="description"
               class=" h-48 mx-5 my-1  overflow-y-auto p-3 rounded-lg outline-none  focus:border-2  focus:border-blue-600 bg-gray-100  hover:bg-gray-200 "
               maxlength="600" placeholder="Group info " style="width: 650px;"></textarea>
            <center>
               <button class=" w-20 h-10 mb-2 rounded-lg  text-white bg-blue-900  bottom-2" name="##">create</button>
            </center>
         </form>
      </div>
      <div class=" bg-white justify-center translate-y-1/2 z-50 shadow-md shadow-gray-400 rounded-sm fixed opacity-0 "
         id="join" style="width: 600px; height: 270px;  left: 50%; top:50%; transform: translate(-50%, -50%);  ">
         <button class="absolute right-3 top-1" onclick="annuler()"><i class="fa-solid fa-xmark fa-xl "
               style="color: rgb(173, 14, 14);"></i></button>
         <p class="text-2xl ml-5 mt-3 font-medium">Join Group</p>
         <label for="code" class="ml-6 pt-6">Enter the code of the group you want to join </label>
         <form accept="##" method="post">
            <input name="code" id="code" type="text" placeholder="Group code"
               class="m-6 mb-2 pl-5 bg-gray-100 text-xl rounded-b-none border-black outline-none rounded-lg  placeholder:text-blue-400 focus:border-b-2 focus:border-blue-800 focus:rounded-b-none hover:bg-gray-200"
               style="width: 550px; height: 70px;" autofocus>
            <button class="w-52 h-16 rounded-lg text-xl text-white bg-blue-900 absolute bottom-4 right-1/3 "
               name="##">SEND</button>
         </form>
      </div>
      <style>
         .tabAnim {
            z-index: 1;
         }

         #option0:checked~div {
            --tw-translate-x: 0%;
         }

         #option1:checked~div {
            --tw-translate-x: 100%;
         }
      </style>
      <!-- ::::::::::1::::::::L -->
      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/1.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-1 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-trash fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>
      </div>
      <!-- ::::::::::1::::::::L -->
      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/2.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-2 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-right-to-bracket fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>

      </div>

      <!-- ::::::::::1::::::::L -->
      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/3.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-3 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-trash fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>

      </div>
      <!-- ::::::::::1::::::::L -->
      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/4.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-4 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-right-to-bracket fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>

      </div>
      <!-- ::::::::::1::::::::L -->
      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/5.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-5 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-trash fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>

      </div>
      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/6.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-6 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-right-to-bracket fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>

      </div>

      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/7.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-1 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-trash fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>

      </div>
      <!-- ::::::::::::::::::::::: -->
      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/8.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-2 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-right-to-bracket fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>

      </div>
      <!-- ::::::::::::::::::::::::::::::::::::::: -->
      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/9.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-3 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-trash fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>
      </div>
      <!-- ::::::::::::::::::::::::::::::::::::::: -->
      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/10.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-4 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-trash  fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>
      </div>
      <!-- ::::::::::::::::::::::::::::::::::::::: -->
      <div
         class=" res-width h-64  bg-gray-50 shadow-md mt-4 mb-1 ml-5 shadow-gray-300 cursor-pointer rounded-md relative group_p">
         <div class="w-full h-24 relative  bg-[url('./icons/11.png')] bg-150 bg-no-repeat bg-right">
            <div class="w-full h-24 absolute bg-5 opacity-75 ">
               <p class="text-white ml-4 text-2xl pt-2 font-medium">goupe_title<br>
               <p class="text-white ml-4 mt-6">firstname lastname</p>
               </p>
            </div>
            <img src="per.JPG" class="size-16 rounded-full absolute bottom-0 right-3 translate-y-7">
         </div>
         <div class="w-full overflow-y-auto relative bg-transparent" style="max-height: 160px;">
            <p class=" ml-4 pt-1 h-fit  text-gray-700 text-sm"><span class="text-lg text-gray-400">Company or
                  university</span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad rem omnis voluptate
               facilis repudiandae est dolor excepturi corporis, eaque quidem aspernatur ea similique sit illo tempora
               error cumque dolorum exercitationem.
            </p>
         </div>
         <button><i class="colore fa-solid fa-trash fa-lg absolute bottom-4 right-4 hover:scale-95 "
               style="color: #e52323;"></i></button>
      </div>



      <!-- <i class="fa-solid fa-plus"></i> -->
      <div class="fixed bottom-0 right-0 h-40 w-96">
         <button id="plus" onclick="list()" class="size-14 absolute bottom-6 rounded-full p-2  right-6 "
            style="background-color: #2ca0d9;color: #fff;"> <i class="fa-solid fa-plus fa-xl"></i></button>
         <div class="w-52 h-28 absolute left-20 top-2 opacity-0 hidden shadow-md bg-green-50 border " id="select">
            <p class="w-52 h-12 text-xl text-gray-600  text-center pt-2 mt-2 border-b-2 border-gray-100 hover:bg-green-100 cursor-pointer"
               onclick="join()">Join Group</p>
            <p class="w-52 h-12 text-xl text-gray-600  text-center pt-2 border-b-2  border-gray-100 hover:bg-green-100 cursor-pointer"
               onclick="create()">Create a Group</p>
         </div>
      </div>
   </main>


</body>
<script src="https://kit.fontawesome.com/71d0f31537.js" crossorigin="anonymous"></script>
<script>

   function list() {
      let btt = document.getElementById('select');
      let valeur = window.getComputedStyle(btt).getPropertyValue('opacity');
      if (valeur == '0') {
         btt.style.opacity = '1';
         btt.style.display = 'grid'
         btt.style.visibility = 'visible'


         //  
      }
      else {
         btt.style.opacity = '0';
         btt.style.display = 'none';
         btt.style.visibility = 'hidden'

      }
   }
   function create() {
      let creat = document.getElementById('create');
      let join = document.getElementById('join');
      let main = document.querySelectorAll('.group_p');
      let value = window.getComputedStyle(join).getPropertyValue('opacity');
      let valeur = window.getComputedStyle(creat).getPropertyValue('opacity');
      let btt = document.getElementById('select');
      if (value == '1') {
         join.style.zIndex = '0';
         join.style.opacity = '0';
         btt.style.opacity = '0';
         btt.style.display = 'none';
      }

      if (valeur == '0') {
         creat.style.zIndex = '200';
         creat.style.opacity = '1';
         btt.style.opacity = '0';
         btt.style.display = 'none';
      }
      main.forEach(function (element) {
         element.style.opacity = '0.4';
         element.style.filter = 'blur(5px)';
      });

   }
   function join() {
      let join = document.getElementById('join');
      let creat = document.getElementById('create');
      let main = document.querySelectorAll('.group_p');
      let valeur = window.getComputedStyle(join).getPropertyValue('opacity');
      let value = window.getComputedStyle(creat).getPropertyValue('opacity');

      let btt = document.getElementById('select');
      if (value == '1') {
         creat.style.zIndex = '0';
         creat.style.opacity = '0';
         btt.style.opacity = '0';
         btt.style.display = 'none';
      }

      if (valeur == '0') {
         join.style.zIndex = '200';
         join.style.opacity = '1';
         btt.style.opacity = '0';
         btt.style.display = 'none';
         // main.style.opacity='0.4';
      }
      main.forEach(function (element) {
         element.style.opacity = '0.4';
         element.style.filter = 'blur(5px)';
      });
   }
   function annuler() {
      let creat = document.getElementById('create');
      let join = document.getElementById('join');
      let main = document.querySelectorAll('.group_p');
      creat.style.zIndex = '0';
      join.style.zIndex = '0';
      creat.style.opacity = '0';
      join.style.opacity = '0';

      main.forEach(function (element) {
         element.style.opacity = '1';
         element.style.filter = 'blur(0px)';
      });
      vider();
   }
   function vider() {

   var inputs = document.querySelectorAll('input');
   inputs.forEach(function (input) {
      if (input.name !== '_token') {  // Check if it's not the CSRF token
         input.value = '';
      }
   });

   }
   annuler();
   // let btt = document.getElementById('select');
   let valeur = window.getComputedStyle(btt).getPropertyValue('opacity');
   btt.style.opacity = '0';
   btt.style.display = 'none';
   btt.style.visibility = 'hidden'



</script>

</html>