<template>
    <Guest>
        <div class="bg-blue-50">
            <el-carousel :interval="5000" arrow="always" class="el-carousel__container2">
                <el-carousel-item v-for="item in 4" :key="item" class="el-carousel__container2">
                    <img src="/slider-products/render.jpg" alt="">
                    <!--                <img src="/slider-products/banner_img.png" alt="">-->
                </el-carousel-item>
            </el-carousel>
            <div class="container">
                <el-row :gutter="20" class="tac py-5">
                    <el-col :span="5" height="500">
                        <el-menu
                        default-active="2"
                        class="el-menu-vertical-demo radius"
                    >
                        <el-sub-menu :index="category.id" v-for="category in categories">
                            <template #title >
                                <span class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">{{category.name}}</span>
                            </template>
                            <template v-for="category_sub in category.category_sub">
                                <el-menu-item :index="category_sub.category_id">
                                    <el-checkbox @change="onChange(category_sub.id)" :label="category_sub.name"/>
                                </el-menu-item>
                            </template>
                        </el-sub-menu>
                    </el-menu>
                        <Link :href="route('home')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-4" >Reset</Link>
                    </el-col>
                    <el-col :span="19">
                        <el-row :gutter="24" >
                            <el-col :span="6" v-for="product in products.data" class="mb-4">
                                <a :href="product.link" target="_blank">
                                <div class="max-w-sm h-100 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                    <img class="rounded-t-lg" :src="product.image" alt="" />
                                    <div class="p-5">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{product.name}}</h5>
                                        <a :href="product.link" target="_blank" class="gap-2 mr-2 inline-flex items-center float-end px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Go product
                                            <el-icon><Right /></el-icon>
                                        </a>
                                    </div>
                                </div>
                                </a>
                            </el-col>
                        </el-row>
                        <div class="my-4">
                            <el-pagination
                                background
                                layout="prev, pager, next"
                                class="d-flex justify-content-center mt-4"
                                :total="products.meta.total"
                                @current-change="tableState.page = $event"
                            />
                        </div>
                    </el-col>
                </el-row>
                <el-carousel  type="card" class="carousel-bottom">
                    <el-carousel-item :interval="4000" v-for="product in products.data" :key="item" >
                        <img class="img-carousel-bottom" :src="product.image" alt="">
                    </el-carousel-item>
                </el-carousel>
            </div>
        </div>
    </Guest>
</template>
<script setup>

import Guest from "@/Layouts/Guest.vue";
import {ref, watch, reactive} from 'vue'
import {Right} from '@element-plus/icons-vue'
import {merge, pickBy} from "lodash";
import {Inertia} from "@inertiajs/inertia";

const
    props = defineProps({
        auth: Object,
        categories: Array,
        category_subs: Array,
        products: Array,
    }),

    tableState = reactive(
        pickBy(
            merge({
                page: 1,
                orderBy: 'id',
                orderByDir: 'desc',
                filter: null
            })
        )
    ),
    onChange = (event) => {
        tableState.filter = event
    }


watch(tableState, newState => {
    Inertia.replace(location.pathname, {
        data: newState,
    })
})


</script>

<style>
.el-carousel__container2 {
    height: 730px !important;
}

.el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n + 1) {
    background-color: #d3dce6;
}
.el-menu{
    border-radius: 10px;
}
.rounded-t-lg{
    height: 190px;
}
.carousel-bottom{
    margin-top: 50px;
}
.img-carousel-bottom{
    height: 100%;
    width: 100%;
}
</style>
