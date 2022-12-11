<template>
    <div>
    <Head>
   
    </Head>
        <NavBar></NavBar>
            <slot />
        <Footer></Footer>
    </div>
</template>
<script>
import Footer from '@/Components/Home/Footer.vue';
import { Head } from '@inertiajs/inertia-vue3'
import NavBar from '@/Components/Home/NavBar.vue';
export default {
    components: { NavBar, Footer, Head }
}
</script>
<style>
a{
  text-decoration: none;
}
    
</style>