<template>
    <div class="max-w-screen-lg mx-auto text-gray-900">
        <div class="flex justify-center">
            <div class="flex-1">
                <div class="border w-auto">
                    <div  class="border p-4 font-semibold ">Компании</div>

                    <div class="bg-white w-full">


                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Color
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        Apple MacBook Pro 17"
                                    </th>
                                    <td class="px-6 py-4">
                                        Sliver
                                    </td>
                                    <td class="px-6 py-4">
                                        Laptop
                                    </td>
                                    <td class="px-6 py-4">
                                        $2999
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        Microsoft Surface Pro
                                    </th>
                                    <td class="px-6 py-4">
                                        White
                                    </td>
                                    <td class="px-6 py-4">
                                        Laptop PC
                                    </td>
                                    <td class="px-6 py-4">
                                        $1999
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        Magic Mouse 2
                                    </th>
                                    <td class="px-6 py-4">
                                        Black
                                    </td>
                                    <td class="px-6 py-4">
                                        Accessories
                                    </td>
                                    <td class="px-6 py-4">
                                        $99
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

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
import moment from 'moment'
import CircleSvg from '../components/CircleSvg.vue';
export default {
    components : {
        XIcon,
        Errors,
        Success,
        CircleSvg
    },
    data() {
        return {
            email :  '' ,
            name :  '',
            errors : null,
            success : '' ,
            busy : false ,

        }
    },
    computed : {
        user() {
            return this.$store.getters.user
        },
        verified() {
            return this.$store.getters.verified
        }
    },

    methods : {
        async update(){
            this.busy = true ;
            this.errors = null
            this.success = ''
            try {
                await this.$store.dispatch('profile' , {'email' : this.email , 'name' : this.name})
                this.success = 'profile updated successfully !'
            }
            catch (e){
                this.errors = e.data
            };
            this.busy = false ;

        },
        moment: function () {
            return moment();
        }
    },


    mounted() {
        this.name = this.user.name
        this.email = this.user.email
    },


}
</script>
