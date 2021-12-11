<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div style="height: 50vh; overflow-y:auto" id="messages" class="p-6 bg-white border-b border-gray-200">
                    
                </div>
                <form  id="chat2" action="{{route('chat')}}" method="post">
                    <x-input id="msg" class="block mt-1 w-full" type="text" name="msg"  required autofocus />
                    <x-button  style="margin-top: 5px">Send</x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
