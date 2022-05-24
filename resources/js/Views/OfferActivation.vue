<template>
  <div class="max-w-screen-lg mx-auto text-gray-900">
    <div class="flex justify-center">
        <div class="flex-1">
            <div class="border w-auto">
                <div  class="border p-4 font-semibold ">Активация предложения</div>

                <div class="p-4 bg-white">
                    <div class="text-center">
                        <h1 class="font-normal text-3xl text-grey-800 font-medium leading-loose my-3 w-full">Активировать код</h1>
                        <div class="w-full text-center">
                            <form >
                                <div class="max-w-sm mx-auto p-1 pr-0 flex items-center">
                                    <input type="text" placeholder="123123"
                                           class="flex-1 appearance-none rounded shadow p-3 text-grey-dark mr-2 focus:outline-none">
                                    <button type="submit"
                                            class="bg-blue-600 text-white text-base font-semibold rounded-md shadow-md hover:bg-indigo-600 p-3">Активировать</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
            role : '',
            errors : null,
            success : '' ,
            busy : false ,
            offers: null

        }
    },
    computed : {
        user() {
            return this.$store.getters.user
        },
        userRoles() {
            return this.$store.getters.userRoles ;
        },
        userPermissions() {
            return this.$store.getters.userPermissions ;
        },
        verified() {
            return this.$store.getters.verified
        }
    },

    methods : {
        moment: function () {
            return moment();
        },
        // async getOffersForUser: function () {
        //     await 123;
        // },
        // async getOffersForUser: function () {
        //     await 123;
        // }
    },


    mounted() {
        this.name = this.user.name
        this.email = this.user.email
        this.role = this.userRoles[0].name
    },


}
</script>
