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
                        <li v-on:click="setUserActive(user.id)" :class="(userSelectedId && userSelectedId == user.id)  ? 'bg-gray-200 bg-opacity-50' : ''" v-for="user in users" :key="user.id" @click="() => {getMessages(user.id)}" class="p-6 text-large text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-gray-200 hover:bg-opacity-50 hover:cursor-pointer">
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
                        <div v-for="message in messages" :key="message.id" :class="(message.from == $page.auth.user.id) ? 'text-right' : '' " class="w-full mb-3 single-message">
                            <p :class="(message.from == $page.auth.user.id) ? 'messageFromMe' : 'messageToMe'" class="inline-block p-2 rounded-md" style="max-width: 75%;">
                                {{ message.content }}
                            </p>
                            <span class="block mt-1 text-xs text-gray-500">{{ message.created_at | formatDate}}</span>
                        </div>

                    </div>

                    <!-- Submit message form -->
                    <div v-if="userSelectedId" class="w-full bg-gray-200 bg-opacity-25 p-6 border-t border-gray-200">
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
            userSelectedId: null,
            message: "",
        }
    },

    methods: {
        setUserActive(userId) {
            this.userSelectedId = userId;
        },

        scrollToMessageBoxBottom: function () {
            if(this.messages.length){
                document.querySelectorAll(".single-message:last-child")[0].scrollIntoView();
            }
        },

        getMessages: async function (userId) {
            //clear the message box
            this.messages = [];

            await axios.get(`/api/messages/${userId}`).then(response => {
                this.messages = response.data.messages
            });

            this.scrollToMessageBoxBottom();
        },

        sendMessage: async function () {
            if(this.message != "" || this.message.length > 0) {
                await this.messages.push({
                    'from': 1,
                    'to': this.userSelectedId,
                    'content': this.message,
                    'created_at': new Date().toISOString(),
                    'updated_at': new Date().toISOString(),
                });

                this.scrollToMessageBoxBottom();

                let message = this.message;
                this.message = "";

                axios.post("/api/messages/", {
                    "to": this.userSelectedId,
                    "content": message
                }).then(() => {
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
