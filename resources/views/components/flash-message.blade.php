@vite('resources/css/app.css')
<script src="//unpkg.com/alpinejs" defer></script>
@if (session()->has('message'))
    <div id="message" style="z-index: 999"
        class="px-42 fixed bottom-6 right-[-460px] z-50 flex min-w-[350px] max-w-[420px] rounded-md border-b-[6px] border-green-700 bg-green-200 p-3 py-3 text-green-800 shadow-xl transition duration-500">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" fill="#166534" x="0px" y="0px" width="40"
                height="40" viewBox="0 0 24 24">
                <path
                    d="M 12 2 C 6.5 2 2 6.5 2 12 C 2 17.5 6.5 22 12 22 C 17.5 22 22 17.5 22 12 C 22 10.9 21.8 9.8007812 21.5 8.8007812 L 19.800781 10.400391 C 19.900781 10.900391 20 11.4 20 12 C 20 16.4 16.4 20 12 20 C 7.6 20 4 16.4 4 12 C 4 7.6 7.6 4 12 4 C 13.6 4 15.100391 4.5007812 16.400391 5.3007812 L 17.800781 3.9003906 C 16.200781 2.7003906 14.2 2 12 2 z M 21.300781 3.3007812 L 11 13.599609 L 7.6992188 10.300781 L 6.3007812 11.699219 L 11 16.400391 L 22.699219 4.6992188 L 21.300781 3.3007812 z">
                </path>
            </svg>
        </div>
        <p class="text-xl">{{ session('message') }} </p>
    </div>
@endif

@if (session()->has('error'))
    <div id="message" style="z-index: 999"
        class="px-42 fixed bottom-6 right-[-460px] z-50 flex min-w-[350px] max-w-[420px] rounded-md border-b-[6px] border-red-700 bg-red-200 p-3 py-3 text-red-800 shadow-xl transition duration-500">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" x="0px" y="0px" width="40" height="40"
                viewBox="0 0 48 48">
                <path fill="#b91c1c" d="M21.5 4.5H26.501V43.5H21.5z" transform="rotate(45.001 24 24)"></path>
                <path fill="#b91c1c" d="M21.5 4.5H26.5V43.501H21.5z" transform="rotate(135.008 24 24)"></path>

            </svg>
        </div>
        <p class="text-xl">{!! session('error') !!}</p>
    </div>
@endif

@if (session()->has('info'))
    <div id="message" style="z-index: 999"
        class="px-42 fixed bottom-6 right-[-460px] z-50 flex min-w-[350px] max-w-[420px] rounded-md border-b-[6px] border-blue-700 bg-blue-200 p-3 py-3 text-blue-800 shadow-xl transition duration-500">
        <div class="flex items-center">
            <svg class="mr-2" width="40" height="40" viewBox="-0.5 0 25 25" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 21.5C17.1086 21.5 21.25 17.3586 21.25 12.25C21.25 7.14137 17.1086 3 12 3C6.89137 3 2.75 7.14137 2.75 12.25C2.75 17.3586 6.89137 21.5 12 21.5Z"
                    stroke="#1e40af" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M12.9309 8.15005C12.9256 8.39231 12.825 8.62272 12.6509 8.79123C12.4767 8.95974 12.2431 9.05271 12.0008 9.05002C11.8242 9.04413 11.6533 8.98641 11.5093 8.884C11.3652 8.7816 11.2546 8.63903 11.1911 8.47415C11.1275 8.30927 11.1139 8.12932 11.152 7.95675C11.19 7.78419 11.278 7.6267 11.405 7.50381C11.532 7.38093 11.6923 7.29814 11.866 7.26578C12.0397 7.23341 12.2192 7.25289 12.3819 7.32181C12.5446 7.39072 12.6834 7.506 12.781 7.65329C12.8787 7.80057 12.9308 7.97335 12.9309 8.15005ZM11.2909 16.5301V11.1501C11.2882 11.0556 11.3046 10.9615 11.3392 10.8736C11.3738 10.7857 11.4258 10.7057 11.4922 10.6385C11.5585 10.5712 11.6378 10.518 11.7252 10.4822C11.8126 10.4464 11.9064 10.4286 12.0008 10.43C12.094 10.4299 12.1863 10.4487 12.272 10.4853C12.3577 10.5218 12.4352 10.5753 12.4997 10.6426C12.5642 10.7099 12.6143 10.7895 12.6472 10.8767C12.6801 10.9639 12.6949 11.0569 12.6908 11.1501V16.5301C12.6908 16.622 12.6727 16.713 12.6376 16.7979C12.6024 16.8828 12.5508 16.96 12.4858 17.025C12.4208 17.09 12.3437 17.1415 12.2588 17.1767C12.1738 17.2119 12.0828 17.23 11.9909 17.23C11.899 17.23 11.8079 17.2119 11.723 17.1767C11.6381 17.1415 11.5609 17.09 11.4959 17.025C11.4309 16.96 11.3793 16.8828 11.3442 16.7979C11.309 16.713 11.2909 16.622 11.2909 16.5301Z"
                    fill="#1e40af" />
            </svg>
        </div>
        <p class="text-xl">{{ session('info') }} </p>
    </div>
@endif

@if (session()->has('info') || session()->has('error') || session()->has('message'))
    <script>
        window.onload = function() {
            // Select the element to remove
            const element = document.getElementById("message");

            if (element) {
                element.classList.toggle('-translate-x-[470px]');
                // Set a timeout to remove the element after 3 seconds
                setTimeout(function() {
                    element.remove();
                }, 4000);
                setTimeout(function() {
                    element.classList.toggle('translate-x-[470px]');
                }, 3000);
            } else {
                // Handle the case where the element is not found
                console.warn("Element with ID 'your-element-id' not found.");
            }
        };
    </script>
@endif
