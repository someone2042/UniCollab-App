@vite('resources/css/app.css')
<script src="//unpkg.com/alpinejs" defer></script>
@if(session()->has('message'))
<div x-data="{ show: true }" x-init="setTimeout(()=>show=false,3000)" x-show="show" class="fixed top-10 left-1/2 transform shadow-xl z-50 p-3 rounded-md -translate-x-1/2 bg-green-700 text-white px-42 py-3">
    <p class="text-xl">{{session('message')}} </p>
</div>
@endif