<template>
    <div class="shadow-md bg-white ">
        <div class="max-w-screen-lg mx-auto flex justify-between">
            <div class=" p-4 ">
                <router-link class="inline-block" :to="{name : 'welcome'}">
                    <LocationMarkerIcon class="h-6 w-6 text-gray-700 mr-3"></LocationMarkerIcon>
                </router-link>
                <router-link active-class="font-semibold text-gray-900" v-if="user" class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'home' }">
                    Личный кабинет
                </router-link>
                <router-link active-class="font-semibold text-gray-900" v-if="user && user.roles[0].slug === 'client'" class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'my offers' }">
                    Мои предложения
                </router-link>
                <router-link active-class="font-semibold text-gray-900" v-if="user && user.roles[0].slug === 'company'" class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'my company' }">
                    Моя компания
                </router-link>
                <router-link active-class="font-semibold text-gray-900" v-if="user && user.roles[0].slug === 'admin'" class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'companies' }">
                    Компании
                </router-link>
                <router-link active-class="font-semibold text-gray-900" v-if="user && user.roles[0].slug === 'admin'" class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'offers' }">
                    Предложения
                </router-link>
            </div>

            <div v-if="user" class="relative "  ref="dropMenu">
                <div @click="drop=!drop"  class=" flex items-center cursor-pointer p-4  font-semibold tracking-wider text-lg">
                    {{user.name}} (Роль: {{user.roles[0].name}})
                <ChevronDownIcon class="h-5 w-5 text-gray-700 ml-2 mt-1"></ChevronDownIcon>

                </div>

                <div v-if="drop" @click="drop=!drop" class="absolute bg-white border z-10 shadow-md flex w-auto flex-col ">
                    <router-link class="p-4 flex items-center" :to="{ name: 'settings' }">
                        <CogIcon class="h-6 w-6 text-gray-700 mr-2"></CogIcon>
                        Настройки
                    </router-link>

                    <div @click="logout" class="p-4 flex  items-center cursor-pointer">
                        <LogoutIcon class="h-6 w-6 text-gray-700 mr-2"></LogoutIcon>
                        Выйти
                    </div>
                </div>
            </div>

            <div v-else class="flex">
                <router-link class="p-4 tracking-widest flex items-center  text-gray-600"
                    active-class="font-semibold text-gray-800"
                    :to="{ name: 'login' }">
                        Логин
                </router-link>
                <router-link class="p-4 tracking-widest flex items-center  text-gray-600"
                    active-class="font-semibold text-gray-800"
                    :to="{ name: 'register' }">
                        Регистрация
                </router-link>


            </div>
        </div>
    </div>
</template>
<script>
import { CogIcon , LogoutIcon , ChevronDownIcon } from '@heroicons/vue/outline';
import { LocationMarkerIcon  } from '@heroicons/vue/solid';

export default {
    created: function() {
        if(this.$store.getters.user) {
            let self = this ;
            window.addEventListener('click', function(e){
                if ( self.$refs.dropMenu && !self.$refs.dropMenu.contains(e.target) ){
                    self.drop = false
                }
            })
        }
    },

    components: { CogIcon , LogoutIcon , ChevronDownIcon, LocationMarkerIcon } ,
    data() {
        return {
            drop : false ,
        }
    },
    computed : {
        user() {
            return this.$store.getters.user ;
        }
    },
    methods : {
        async logout() {
            await this.$store.dispatch('logout');
            this.$router.push({name : 'login'});
        }
    }
}
</script>
