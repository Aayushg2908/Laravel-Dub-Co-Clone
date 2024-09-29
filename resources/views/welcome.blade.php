<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <wireui:scripts />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="antialiased font-sans relative">
    <img src="https://play.tailwindcss.com/img/beams.jpg" alt="beam"
        class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2 w-screen h-screen" />

    <div
        class="absolute inset-0 bg-[url(https://play.tailwindcss.com/img/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
    </div>

    <nav class="w-full h-[60px] flex items-center justify-around relative">
        <h1 class="text-2xl font-bold">dub</h1>
        <div class="flex items-center gap-x-2">
            <x-button sm flat black rounded="full" href="{{ route('register') }}" wire:navigate label="Register" />
            <x-button sm black rounded="full" href="{{ route('login') }}" wire:navigate label="Login" />
        </div>
    </nav>

    <main class="w-full mt-20 flex flex-col items-center relative">
        <h1 class="text-7xl font-extrabold tracking-tight">Short Links With</h1>
        <p
            class="text-7xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 via-red-500 to-orange-400 tracking-tight">
            Superpowers</p>
        <span class="mt-6 text-xl text-gray-500">Dub.co is the open-source link management <br /> infrastructure for
            modern
            marketing
            teams.</span>
        <div class="flex items-center mt-4">
            <x-button xl black rounded="full" href="{{ route('login') }}" wire:navigate label="Start for Free" />
        </div>
    </main>

    <div class="w-[450px] bg-gray-100 mx-auto mt-8 relative">
        <x-card shadow="lg" rounded="xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-x-3">
                    <img src="https://www.google.com/s2/favicons?sz=64&domain_url=dub.co" alt="logo"
                        class="w-10 h-10" />
                    <div class="flex flex-col">
                        <div class="flex items-center gap-x-2">
                            <a href="url-shortener.test/try" target="_blank"
                                class="font-extrabold text-lg tracking-tighter">url-shortener.test/try</a>
                            <x-mini-button outline black rounded id="copy-button" sm>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy">
                                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                                </svg>
                            </x-mini-button>
                            <x-button outline black xs>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-mouse-pointer-click">
                                    <path d="M14 4.1 12 6" />
                                    <path d="m5.1 8-2.9-.8" />
                                    <path d="m6 12-1.9 2" />
                                    <path d="M7.2 2.2 8 5.1" />
                                    <path
                                        d="M9.037 9.69a.498.498 0 0 1 .653-.653l11 4.5a.5.5 0 0 1-.074.949l-4.349 1.041a1 1 0 0 0-.74.739l-1.04 4.35a.5.5 0 0 1-.95.074z" />
                                </svg>
                                <span class="text-xs font-extrabold">1k Clicks</span>
                            </x-button>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-corner-down-right">
                                <polyline points="15 10 20 15 15 20" />
                                <path d="M4 4v7a4 4 0 0 0 4 4h12" />
                            </svg>
                            <a href="url-shortener.test/register" target="_blank"
                                class="tracking-tighter">url-shortener.test/register</a>
                        </div>
                    </div>
                </div>

                <x-mini-button rounded flat black sm>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-ellipsis-vertical">
                        <circle cx="12" cy="12" r="1" />
                        <circle cx="12" cy="5" r="1" />
                        <circle cx="12" cy="19" r="1" />
                    </svg>
                </x-mini-button>
            </div>
        </x-card>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const copyButton = document.getElementById('copy-button');
        copyButton.addEventListener('click', () => {
            copyToClipboard('url-shortener.test/try');
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: 'Link copied to clipboard',
                showConfirmButton: false,
                timer: 1000
            });
        });
    });

    function copyToClipboard(text) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).catch(err => {
                console.error('Failed to copy: ', err);
            });
        } else {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
            document.body.removeChild(textArea);
        }
    }
</script>

</html>
