<template>
    <Head title="Create Product" />
    <Authenticated>
      <div class="flex justify-end">
        <Link :href="route('product.index')"
          class="bg-gradient-fuchsia inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-size-xs bg-150 active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 border-fuchsia-500 text-white hover:opacity-75">
        Back</Link>
      </div>
      <div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="mt-5 md:col-span-2 md:mt-0">
            <form @submit.prevent="onSubmit">
              <div class="shadow sm:overflow-hidden sm:rounded-md border border-solid">
                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                  <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                      <label for="category_id" class="block text-sm font-medium text-gray-700">Choose Category</label>
                        <select name="category_id" id="category_id" v-model="form.category_sub_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option v-for="category in category_subs" :key="category.id"
                            :value="category.id">{{category.name}}</option>
                        </select>
                        <div class="text-red-600">
                          {{ errors.category_sub_id }}
                        </div>
                    </div>
                  </div>
                  <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <div class="relative">
                          <input type="text"  name="name" v-model="form.name" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                          <label for="name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Product name</label>
                        </div>
                        <div class="text-red-600">
                          {{ errors.name }}
                        </div>
                    </div>
                  </div>
                  <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <div class="relative">
                          <input type="text"  name="name" v-model="form.link" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                          <label for="name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Product Link</label>
                        </div>
                        <div class="text-red-600">
                          {{ errors.link }}
                        </div>
                    </div>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Product image</label>
                    <div
                      class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                      <div class="space-y-1 text-center">
                        <div class="flex text-sm text-gray-600">
                            <input name="image" @input="form.image = $event.target.files[0]" class="block mb-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="default_size" type="file">
                        </div>
                        <div class="flex text-sm text-gray-600">
                            <img :src="image" class="w-30 h-30" alt="">
                        </div>
                        <div class="text-red-600">
                          {{ errors.image }}
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
    </Authenticated>
  </template>


<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Authenticated from "@/Layouts/Authenticated.vue";

const props = defineProps({
    product: Object,
    category_subs: Object,
    image: Object,
    errors: Object
})

const form = useForm({
    _method: "put",
    name: props.product.name,
    category_sub_id: props.product.category_sub_id,
    link: props.product.link,
    image: null,
})

const onSubmit = () => {
    form.post(route('product.update',props.product.id), {
        onSuccess: response => {
            ElMessage({
                message: 'Product has been successfully updated.',
                type: 'success',
            });
            Inertia.reload();
        }
    });
}
</script>
