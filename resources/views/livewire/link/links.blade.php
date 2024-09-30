<div class="w-full flex flex-col gap-4">
    <x-button label="Create Link" icon="plus" x-on:click="$openModal('create-link-modal')" />

    @foreach ($links as $link)
        <div class="max-w-[500px] w-full mx-auto mt-8 relative">
            <x-card shadow="lg" rounded="xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-x-3">
                        <img src="https://www.google.com/s2/favicons?sz=64&domain_url=dub.co" alt="logo"
                            class="w-10 h-10" />
                        <div class="flex flex-col">
                            <div class="flex items-center gap-x-2">
                                <a href="/" target="_blank"
                                    class="font-extrabold text-lg tracking-tighter line-clamp-1 max-w-[200px]">
                                    url-shortener.test/{{ $link->slug }}
                                </a>
                                <x-mini-button outline black rounded id="copy-button-{{ $link->id }}" sm
                                    x-data=""
                                    x-on:click="copyToClipboard('url-shortener.test/{{ $link->slug }}', 'copy-button-{{ $link->id }}')">
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
                                    <span class="text-xs font-extrabold">{{ $link->click_count }} Clicks</span>
                                </x-button>
                            </div>
                            <div class="flex items-center gap-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-corner-down-right">
                                    <polyline points="15 10 20 15 15 20" />
                                    <path d="M4 4v7a4 4 0 0 0 4 4h12" />
                                </svg>
                                <a href="{{ $link->original_url }}" target="_blank"
                                    class="tracking-tighter">{{ $link->original_url }}</a>
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
    @endforeach

    <x-modal-card name="create-link-modal" title="Create Link">
        <form wire:submit.prevent="createLink">
            <div class="mt-2">
                <x-input label="Original URL" id="original_url" name="original_url"
                    placeholder="Enter your original URL" wire:model="original_url" type="url" />
                <x-input-error :messages="$errors->get('original_url')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input label="Slug" id="slug" name="slug" placeholder="Enter your slug" wire:model="slug"
                    type="text" />
                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-x-2">
                <x-button flat black label="Cancel" x-on:click="close" />
                <x-button label="Create" type="submit" />
            </div>
        </form>
    </x-modal-card>
</div>

<script>
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
