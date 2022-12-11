<template>
<div>
    <aside class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
        <SiteSideBar></SiteSideBar>
    </aside>

    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        
        <SiteNavBar></SiteNavBar>

        <div class="w-full px-6 py-6 mx-auto">

            <slot/>
        </div>
        
    </main>
</div>
    
    
</template>


<script>
import SiteNavBar from '@/Components/Dashboard/NavBar.vue';
import SiteSideBar from '@/Components/Dashboard/SideBar.vue';



export default {
    name: "LayoutBasic",
    components: { SiteNavBar, SiteSideBar }
}
</script>
    