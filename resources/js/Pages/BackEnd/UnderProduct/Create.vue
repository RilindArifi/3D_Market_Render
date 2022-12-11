<template>
  <Head title="Create Under Product"/>
  <Dashboard>
    <div class="flex justify-end">
      <Link :href="route('underproduct.index')"
        class="bg-gradient-fuchsia inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-size-xs bg-150 active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 border-fuchsia-500 text-white hover:opacity-75">
      Back</Link>
    </div>
    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="mt-5 md:col-span-2 md:mt-0">
          <form @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="shadow sm:overflow-hidden sm:rounded-md border border-solid">
              <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                <div class="grid grid-cols-3 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="block text-sm font-medium text-gray-700">Choose Category</label>
                        <select name="category_id" id="category_id" v-model="form.category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                          <option v-for="categories in category" :key="categories.id"
                          :value="categories.id">{{categories.name}}</option>
                        </select>
                      <div class="text-red-600">
                        {{ form.errors.category_id }}
                      </div>
                  </div>
                </div>
                <div class="grid grid-cols-3 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Choose Product</label>
                      <select name="product_id" id="product_id" v-model="form.product_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option v-for="products in product" :key="products.id"
                         :value="products.id">{{products.name}}</option>
                      </select>
                      <div class="text-red-600">
                        {{ form.errors.product_id }}
                      </div>
                  </div>
                </div>
                <div class="grid grid-cols-3 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Under Product name</label>
                    <input type="text" name="name" v-model="form.name" id="name" autocomplete="given-name"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                      <div class="text-red-600">
                        {{ form.errors.name }}
                      </div>
                  </div>
                </div>
                <div class="grid grid-cols-3 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label for="link" class="block text-sm font-medium text-gray-700">Link Product</label>
                    <input type="text" v-model="form.link" name="link" id="link" autocomplete="given-name"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                      <div class="text-red-600">
                        {{ form.errors.link }}
                      </div>
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Under Product image</label>
                  <div
                    class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                    <div class="space-y-1 text-center">
                      <div class="flex text-sm text-gray-600">
                          <input name="image" @input="form.image = $event.target.files[0]" class="block mb-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="default_size" type="file">
                      </div>
                      <div class="text-red-600">
                        {{ form.errors.image }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" :disabled="form.processing"
                  class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </Dashboard>
</template>

<script setup>
import Dashboard from '@/Layouts/Dashboard.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";

const
    props = defineProps({
        category: Object,
        product: Object
    }),
    form = useForm({
        name: null,
        category_id: null,
        product_id: null,
        link: null,
        image: null,
    }),

    onSubmit = () => {
        form.post(route('underproduct.store'),{
            onSuccess: response => {
                ElMessage({
                    message: 'Under Product has been successfully created.',
                    type: 'success',
                });
                Inertia.reload();
            }
        })

    }


</script>
