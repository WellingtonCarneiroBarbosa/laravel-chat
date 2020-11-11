<template>
<app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chat
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex overflow-y-scroll" style="min-height: 400px; max-height: 400px;">

                <!-- List Users -->
                <div class="w-3/12 bg-gray-200 bg-opacity-25 border-r border-gray-200">
                    <ul>
                        <li class="p-6 text-large text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-gray-200 hover:bg-opacity-50 hover:cursor-pointer">
                            <p class="flex items-center">
                                Mahara S. Xavier
                                <span class="ml-2 h-2 w-2 bg-blue-500 rounded-full"></span>
                            </p>
                        </li>

                        <li class="p-6 text-large text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-gray-200 hover:bg-opacity-50 hover:cursor-pointer">
                            <p class="flex items-center">
                                Robson I. Barbosa
                                <span class="ml-2 h-2 w-2 bg-blue-500 rounded-full"></span>
                            </p>
                        </li>

                        <li class="p-6 text-large text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-gray-200 hover:bg-opacity-50 hover:cursor-pointer">
                            <p class="flex items-center">
                                Elgson N. Gabriel
                                <span class="ml-2 h-2 w-2 bg-blue-500 rounded-full"></span>
                            </p>
                        </li>
                    </ul>
                </div>

                <!-- Box Messages -->
                <div class="w-9/12 flex flex-col justify-between">

                    <!-- Messages -->
                    <div class="w-full p-6 flex flex-col overflow-y-scroll">

                        <!-- Single Message -->
                        <div class="w-full mb-3 text-right">
                            <p class="inline-block p-2 rounded-md messageFromMe" style="max-width: 75%;">
                                Olá!
                            </p>
                            <span class="block mt-1 text-xs text-gray-500">Hoje 12:21</span>
                        </div>

                        <!-- Single Message -->
                        <div class="w-full mb-3">
                            <p class="inline-block p-2 rounded-md messageToMe" style="max-width: 75%;">
                                Oie
                            </p>
                        </div>

                        <!-- Single Message -->
                        <div class="w-full mb-3">
                            <p class="inline-block p-2 rounded-md messageToMe" style="max-width: 75%;">
                                Tudo bem contigo?
                            </p>
                            <span class="block mt-1 text-xs text-gray-500">Hoje 12:21</span>
                        </div>

                    </div>

                    <!-- Submit message form -->
                    <div class="w-full bg-gray-200 bg-opacity-25 p-6 border-t border-gray-200">
                        <form>
                            <div class="flex rounded-md overflow-hidden border border-gray-300">
                                <input class="flex-1 px-4 py-2 text-sm focus:outline-none" type="text">
                                <button class="bg-indigo-500 rounded-sm hover:bg-indigo-600 text-white px-4 py-2" type="submit">Enviar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
}
</script>

<style>
.messageFromMe {
    @apply bg-indigo-300 bg-opacity-25;
}

.messageToMe {
    @apply bg-gray-200 bg-opacity-25;
}
</style>
