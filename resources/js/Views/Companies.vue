<template>
  <div class="max-w-screen-lg mx-auto text-gray-900">
    <div class="flex justify-center">
        <div class="flex-1">
            <div class="border w-auto">
                <div  class="border p-4 font-semibold ">Личный кабинет</div>

                <div class="p-4 bg-white">
                    <p>Вы в личном кабинете !</p>
                    <p>Ваша роль: {{this.role}}</p>
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
        moment: function () {
            return moment();
        }
    },


    mounted() {
        this.name = this.user.name
        this.email = this.user.email
        this.role = this.user.roles[0].name
    },


}
</script>
