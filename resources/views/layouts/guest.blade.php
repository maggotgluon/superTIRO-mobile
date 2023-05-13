<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Google Tag Manager -->

        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

        })(window,document,'script','dataLayer',"{{ env('GTM', 'SuperTRIO') }}");
        </script>

        <!-- End Google Tag Manager -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SuperTRIO') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @wireUiScripts

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans text-gray-900 antialiased">
    
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ env('GTM', 'SuperTRIO') }}"
                height="0" width="0" style="display:none;visibility:hidden">
            </iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
        
        @if(strpos($_SERVER['HTTP_USER_AGENT'], 'wv') !== false)
        <div class="min-h-screen flex flex-col justify-center items-center gap-4">
            
            <img class="mx-auto h-48 " src="{{url('/icons/caution.svg')}}"/>

            <x-badge negative lg label="ระบบไม่รองรับการเปิดผ่านไลน์ (Line Application)" />
            <p class="text-blue-600 text-xl">กรุณาเปิดเว็บไซต์ผ่านบราวเซอร์</p>
            <div class="flex">
                <img class="mx-auto h-16 " src="{{url('/icons/chrome.svg')}}"/>
                <img class="mx-auto h-16 " src="{{url('/icons/safari.svg')}}"/>
            </div>
            <p class="text-blue-600 text-xl">หรือ สแกนคิวอาร์โค้ดผ่านกล้องปกติ</p>
            
            
            <!-- dots-vertical -->
        </div>
        @elseif( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false)
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                <div>
                    <a href="/">
                        <x-application-logo class="h-20 fill-current text-gray-500" />
                    </a>
                </div>
    
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        @else
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-300">
                <div>
                    <a href="/">
                        <x-application-logo class="h-20 fill-current text-gray-500" />
                    </a>
                </div>
    
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        @endif
        @livewireScripts
    </body>
</html>
