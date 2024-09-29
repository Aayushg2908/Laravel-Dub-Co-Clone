<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-button label="Delete Account" x-on:click="$openModal('confirm-user-deletion')" negative right-icon="trash" />

    <x-modal name="confirm-user-deletion">
        <form wire:submit="deleteUser">
            <x-card title="Delete Account">

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <x-input label="Password" id="password" name="password" placeholder="Enter your password"
                        wire:model="password" type="password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <x-slot name="footer" class="flex justify-end gap-x-4">
                    <x-button outline black label="Cancel" x-on:click="close" />
                    <x-button negative label="Delete Account" class="ms-3" type="submit" />
                </x-slot>
            </x-card>
        </form>
    </x-modal>
</section>
