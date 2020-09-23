<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <h3>New Post</h3>
        </x-slot>
        <x-jet-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <div>
                <x-jet-label value="{{ __('Title') }}"/>
                <x-jet-input class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Body') }}"/>
                <x-jet-input class="block mt-1 w-full" type="text" name="body" :value="old('body')" required/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Create') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
