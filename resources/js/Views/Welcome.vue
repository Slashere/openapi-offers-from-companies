<template>
<div class="min-h-screen flex flex-col ">
    <div class="p-4 absolute flex  top-1 right-1 text-gray-500 text-sm font-semibold uppercase tracking-widest">
      <div v-if="user">
        <router-link class="px-6 " :to="{ name: 'home' }">
          В личный кабинет
        </router-link>
        <router-link class="p-2 mr-4" :to="{ name: 'api-methods' }">
          Список методов API
        </router-link>
      </div>
      <div v-else>
        <router-link class="px-6 " :to="{ name: 'login' }">
          Логин
        </router-link>
        <router-link class="p-2 mr-4" :to="{ name: 'register' }">
          Регистрация
        </router-link>
        <router-link class="p-2 mr-4" :to="{ name: 'api-methods' }">
          Список методов API
        </router-link>
      </div>
    </div>

    <div class="flex-1 flex flex-col items-center justify-center text-gray-600 ">
            <div class="mb-6  text-center  tracking-wider text-8xl sm:mb-8 sm:text-8xl">
                Открытый API для получения скидочных предложений от предприятий
            </div>

            <div class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">
                <a href="https://github.com/Slashere">github.com/Slashere</a>
            </div>
        </div>
    <Countdown deadline="August 22, 2022"></Countdown>
  </div>

</template>


<script>
import Countdown from '../components/Countdown.vue';

export default {
    data() {
        return {
            auth : true
        }
    },
    components: { Countdown },
    computed : {
      user() {
        return this.$store.getters.user ;
      }
    }
}
</script>
