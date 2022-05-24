<template>
<div class="min-h-screen flex flex-col ">

    <div class="flex-1 flex flex-col items-center justify-center text-gray-600 ">
            <div class="mb-6  text-center  tracking-wider text-8xl sm:mb-8 sm:text-8xl">
                404 ошибка
            </div>

        </div>
  </div>

</template>


<script>
export default {
    data() {
        return {
            auth : true
        }
    },
    computed : {
      user() {
        return this.$store.getters.user ;
      }
    }
}
</script>
