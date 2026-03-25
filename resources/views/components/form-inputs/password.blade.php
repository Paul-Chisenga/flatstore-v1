<x-ui.input-group.input-group x-data="{ showPassword: false }">
    <x-ui.input-group.addon>
        <ion-icon name="lock-closed"></ion-icon>
    </x-ui.input-group.addon>
    <x-ui.input-group.input :id="$attributes->get('id')" ::type="showPassword ? 'text' : 'password'" :name="$attributes->get('name')" :autocomplete="$attributes->get('autocomplete', 'current-password')" />
    <x-ui.input-group.button>
        <ion-icon name="eye" class="size-4" @click="showPassword = ! showPassword"></ion-icon>
    </x-ui.input-group.button>
</x-ui.input-group.input-group>
