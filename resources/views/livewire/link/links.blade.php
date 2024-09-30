<div class="w-full flex flex-col gap-4">
    <x-button label="Create Link" icon="plus" x-on:click="$openModal('create-link-modal')" />


    <x-modal-card name="create-link-modal" title="Create Link">
        <form wire:submit.prevent="createLink">
            <div class="mt-2">
                <x-input label="Original URL" id="original_url" name="original_url" placeholder="Enter your original URL"
                    wire:model="original_url" type="url" />
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
