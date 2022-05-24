<template>
  <div class="max-w-screen-lg mx-auto text-gray-900">
      <div class="mb-6 text-center tracking-wider text-8xl sm:mb-8 sm:text-8xl">Добро пожаловать в личный кабинет. </div>
      <div class="mb-6 text-center tracking-wider text-8xl sm:mb-8 sm:text-8xl">Ваша роль: {{this.role}}</div>
    </div>
</template>



<script>
import { XIcon } from '@heroicons/vue/solid';
import Errors from '../components/Errors.vue';
import Success from '../components/Success.vue';
import moment from 'moment'
import CircleSvg from '../components/CircleSvg.vue';

import New from './Companies/New.vue';
import Status from './Companies/Status.vue';
import Todos from './Companies/Todos.vue';


export default {
    components : {
        XIcon,
        Errors,
        Success,
        CircleSvg,
        New,
        Status,
        Todos
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
        }
    },


    mounted() {
        this.name = this.user.name
        this.email = this.user.email
        this.role = this.userRoles[0].name
    },


}
</script>
