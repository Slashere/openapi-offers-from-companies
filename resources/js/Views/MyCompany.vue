<template>
    <div class="max-w-screen-lg mx-auto text-gray-900">
        <div class="flex justify-center">
            <div class="flex-1">
                <div class="border w-auto">
                    <div  class="border p-4 font-semibold ">Моя компания</div>

                    <div class="p-4 bg-white">
                        <Success  v-if="success" :content="success" @close="success=null" />

                        <Errors v-if="errors" :content="errors" @close="errors=null" />
                        <!-- <div v-if="error" class="md:w-10/12 md:p-2 w-full mx-auto text-sm text-red-500 text-white text-center">
                            {{error}}
                        </div> -->
                        <form v-if="companyCreated" class="w-full justify-center">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Название компании
                                    </label>
                                    <input value="Рога и копыта" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Адрес компании
                                    </label>
                                    <input value="Улица Пушкина" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                        Город
                                    </label>
                                    <div class="relative">
                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                            <option value="">Новосибирск</option>
                                            <option>Томск</option>
                                            <option>Омск</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center">
                                <button type="submit" class="p-3 rounded-sm text-white bg-blue-500 hover:bg-blue-600">
                                    Обновить компанию
                                </button>
                            </div>
                        </form>

                        <form v-else class="w-full justify-center">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Название компании
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                        Адрес компании
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                        Город
                                    </label>
                                    <div class="relative">
                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                            <option value="">Новосибирск</option>
                                            <option>Томск</option>
                                            <option>Омск</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center">
                                    <button type="submit" class="p-3 rounded-sm text-white bg-blue-500 hover:bg-blue-600">
                                        Создать компанию
                                    </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>


<script>
import { XIcon } from '@heroicons/vue/solid';
import Errors from '../components/Errors.vue';
import Success from '../components/Success.vue';
import CircleSvg from '../components/CircleSvg.vue';
import api from "../api";

export default {
    components : {
        XIcon,
        Errors,
        Success,
        CircleSvg
    },
    data() {
        return {
            loading: false,
            companyCreated: true,
            password :  '' ,
            password_confirmation :  '',
            errors : null,
            success : '',
            busy : false ,

        }
    },
    async created() {
        let exists = await this.companyExists();
    },
    methods : {
        async update(){
            this.busy = true ;
            this.errors = null
            this.success = ''
            try {
                await this.$store.dispatch('password' , {'password' : this.password ,'password_confirmation' : this.password_confirmation})
                this.success = 'password updated successfully !'
                this.password = ''
                this.password_confirmation = ''
            }
            catch (e){
                this.errors = e.data
            };
            this.busy = false ;

        },
        async companyExists() {
            this.loading = true;
            this.companyCreated = await api.companyExists();
            this.loading = false;
            return this.companyCreated
        },
    },


}
</script>
