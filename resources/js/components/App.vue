<template>
  <div class="h-screen">
        <div>
            <nav-bar v-if="this.$route.name !== 'welcome' && this.$route.name !== 'api-methods'"></nav-bar>
        </div>
        <VerifyNotice :id="id" v-if="(this.$route.name !== 'welcome' && this.$route.name !== 'api-methods') && id && !verified" />
        <div>

          <router-view class="p-6 " v-slot="{ Component }">
            <transition name="fade" mode="out-in" >
              <component :is="Component" />
            </transition>
          </router-view>
        </div>
        <div class="sticky top-[100vh]">
            <footer-bar v-if="this.$route.name !== 'welcome' && this.$route.name !== 'api-methods'"></footer-bar>
        </div>
  </div>
</template>

<script>
import NavBar from './NavBar.vue'
import FooterBar from './FooterBar.vue'
import VerifyNotice from './VerifyNotice.vue'
export default {
  computed : {
    id () {
      return this.$store.getters.id
    },
    verified () {
      return this.$store.getters.verified
    }

  },
  components : {
    NavBar,
    FooterBar,
    VerifyNotice
  },

}
</script>


<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

</style>
