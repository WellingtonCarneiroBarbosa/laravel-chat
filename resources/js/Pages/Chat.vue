<template>
<app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chat
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg flex" style="min-height: 400px; max-height: 400px;">

                <!-- List Users -->
                <div class="w-3/12 bg-gray-200 bg-opacity-25 border-r border-gray-200 overflow-y-scroll">
                    <ul>
                        <li :class="(userSelected && userSelected.id == user.id)  ? 'bg-gray-200 bg-opacity-50' : ''" v-for="user in users" :key="user.id" @click="() => {getMessages(user.id)}" class="p-6 text-large text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-gray-200 hover:bg-opacity-50 hover:cursor-pointer">
                            <p class="flex items-center">
                                {{ user.name }}
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

                        <!--
                            If message is from auth user, it will display on right and blue
                            else, it will display on left and gray
                            -->
                        <div v-for="message in messages" :key="message.id" :class="(message.from == $page.auth.user.id) ? 'text-right' : '' " class="w-full mb-3">
                            <p :class="(message.from == $page.auth.user.id) ? 'messageFromMe' : 'messageToMe'" class="inline-block p-2 rounded-md" style="max-width: 75%;">
                                {{ message.content }}
                            </p>
                            <span class="block mt-1 text-xs text-gray-500">{{ message.created_at | formatDate}}</span>
                        </div>

                    </div>

                    <!-- Submit message form -->
                    <div v-if="userSelected" class="w-full bg-gray-200 bg-opacity-25 p-6 border-t border-gray-200">
                        <form v-on:submit.prevent="sendMessage">
                            <div class="flex rounded-md overflow-hidden border border-gray-300">
                                <input v-model="message" class="flex-1 px-4 py-2 text-sm focus:outline-none" type="text">
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

    data() {
        return {
            users: [],
            messages: [],
            userSelected: null,
            message: "",
        }
    },

    methods: {
        getMessages: async function (userId) {
            axios.get('/api/users/' + userId).then(response => {
                this.userSelected = response.data.user;
            });

            await axios.get(`/api/messages/${userId}`).then(response => {
                this.messages = response.data.messages
            });
        },

        sendMessage: function () {
            if(this.message != "" || this.message.length > 0) {
                this.messages.push(this.message);
                let message = this.message;
                this.message = "";

                let data = {
                    "to": this.userSelected.id,
                    "content": message
                };

                axios.post("/api/messages/", data).then(response => {
                    console.log("message sent!");
                });
            }
        },
    },

    mounted() {
        axios.get("/api/users/except-logged-in").then(response => {
            this.users = response.data.users
        });
    }
}
</script>

<style>
.messageFromMe {
    @apply bg-indigo-300;
    @apply bg-opacity-25;
}

.messageToMe {
    @apply bg-gray-200;
    @apply bg-opacity-25;
}
</style>
