<template>
    <div>
        <Home>
            <SliderTop></SliderTop>
            <section class="cat_product_area section_padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <Link v-if="auth.user != null" href="/dashboard" class="btn btn-success">Go to Dashboard</Link>
                            <div class="left_sidebar_area">
                                <aside class="left_widgets p_filter_widgets">
                                    <div class="l_w_title">
                                        <h3>Categories</h3>
                                    </div>
                                    <div class="widgets_inner">
                                        <ul class="list">
                                            <li v-for="category in categories" :key="category.id">
                                                <Link href="#">{{category.name}}</Link>
                                                <span>(250)</span>
                                            </li>
                                        </ul>
                                    </div>
                                </aside>

                                <aside class="left_widgets p_filter_widgets">
                                    <div class="l_w_title">
                                        <h3>Products</h3>
                                    </div>
                                    <div class="widgets_inner">
                                        <ul class="list">
                                            <li v-for="product in products">
                                                <a href="#">{{product.name}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </aside>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product_top_bar d-flex justify-content-between align-items-center">
                                        <div class="single_product_menu">
                                            <p><span>10000 </span> Prodict Found</p>
                                        </div>
                                        <div class="single_product_menu d-flex">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="search"
                                                    aria-describedby="inputGroupPrepend">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                                            class="ti-search"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center latest_product_inner">
                                <div v-for="category in categories" class="col-lg-4 col-sm-6">
                                    <div class="single_product_item">
                                        <img :src="category.image" alt="" class="rounded-2xl" height="200px">
                                        <div class="single_product_text">
                                            <h4>{{category.name}}</h4>
<!--                                            <a href="#" class="add_cart">+ add to cart<i class="ti-heart"></i></a>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="product_list best_seller">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section_tittle text-center">
                            <h2>Best Sellers <span>shop</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12">
                        <div class="best_product_slider owl-carousel">
                            <div class="single_product_item">
                                <img src="/front/img/product/product_1.png" alt="">
                                <div class="single_product_text">
                                    <h4>Quartz Belt Watch</h4>
                                    <h3>$150.00</h3>
                                </div>
                            </div>
                            <div class="single_product_item">
                                <img src="/front/img/product/product_2.png" alt="">
                                <div class="single_product_text">
                                    <h4>Quartz Belt Watch</h4>
                                    <h3>$150.00</h3>
                                </div>
                            </div>
                            <div class="single_product_item">
                                <img src="/front/img/product/product_3.png" alt="">
                                <div class="single_product_text">
                                    <h4>Quartz Belt Watch</h4>
                                    <h3>$150.00</h3>
                                </div>
                            </div>
                            <div class="single_product_item">
                                <img src="/front/img/product/product_4.png" alt="">
                                <div class="single_product_text">
                                    <h4>Quartz Belt Watch</h4>
                                    <h3>$150.00</h3>
                                </div>
                            </div>
                            <div class="single_product_item">
                                <img src="/front/img/product/product_5.png" alt="">
                                <div class="single_product_text">
                                    <h4>Quartz Belt Watch</h4>
                                    <h3>$150.00</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </Home>
    </div>
</template>
<script setup>

import Home from '@/Layouts/Home.vue'
import SliderTop from './Slider-Top.vue'

const
    props = defineProps({
        auth: Object,
        categories: Array,
        products: Array,
        under_product: Array,
    })


</script>
