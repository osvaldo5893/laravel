<template lang="es">
    <main>
        <!-- <Navbar /> -->
        <div class="">
            <router-view></router-view>
        </div>

    </main>
</template>
<script>
import Navbar from "./Navbar.vue";
export default {
    name:'App',
    components: {
        Navbar
  },

}
</script>
<style lang="">
    
</style>