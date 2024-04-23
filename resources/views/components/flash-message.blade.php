@vite('resources/css/app.css')
<script src="//unpkg.com/alpinejs" defer></script>
@if(session()->has('message'))
<div x-data="{ show: true }" x-init="setTimeout(()=>show=false,3000)" x-show="show" style="z-index: 999" class="fixed top-5 left-1/2 transform shadow-xl z-50 p-3 rounded-md flex -translate-x-1/2 bg-green-200 text-green-800 border-green-700 border-2 px-42 py-3">
    <p class="text-xl">{{session('message')}} </p>
    <svg xmlns="http://www.w3.org/2000/svg" class="mx-2" fill="#166534" x="0px" y="0px" width="30" height="30" viewBox="0 0 24 24">
        <path d="M 12 2 C 6.5 2 2 6.5 2 12 C 2 17.5 6.5 22 12 22 C 17.5 22 22 17.5 22 12 C 22 10.9 21.8 9.8007812 21.5 8.8007812 L 19.800781 10.400391 C 19.900781 10.900391 20 11.4 20 12 C 20 16.4 16.4 20 12 20 C 7.6 20 4 16.4 4 12 C 4 7.6 7.6 4 12 4 C 13.6 4 15.100391 4.5007812 16.400391 5.3007812 L 17.800781 3.9003906 C 16.200781 2.7003906 14.2 2 12 2 z M 21.300781 3.3007812 L 11 13.599609 L 7.6992188 10.300781 L 6.3007812 11.699219 L 11 16.400391 L 22.699219 4.6992188 L 21.300781 3.3007812 z"></path>
    </svg>
</div>
@endif
@if(session()->has('error'))
<div x-data="{ show: true }" x-init="setTimeout(()=>show=false,3000)" x-show="show" style="z-index: 999" class="fixed top-5 left-1/2 transform shadow-xl z-50 p-3 flex rounded-md -translate-x-1/2 bg-red-200 text-red-800 border-red-700 border-2 px-42 py-3">
    <p class="text-xl">{{session('error')}} </p>
    <svg xmlns="http://www.w3.org/2000/svg" class="mx-2" x="0px" y="0px" width="30" height="30" viewBox="0 0 48 48">
        <path fill="#b91c1c" d="M21.5 4.5H26.501V43.5H21.5z" transform="rotate(45.001 24 24)"></path>
        <path fill="#b91c1c" d="M21.5 4.5H26.5V43.501H21.5z" transform="rotate(135.008 24 24)"></path>
    </svg>
</div>
@endif