<template>
<div>
    <Head title="Products" />
    <Authenticated>
        <div class="flex justify-end">
            <Link :href="route('product.create')" class="bg-gradient-fuchsia inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-size-xs bg-150 active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 border-fuchsia-500 text-white hover:opacity-75">+ Add Product</Link>
        </div>
        <div class="relative shadow-md sm:rounded-lg mt-3">
            <div class="flex justify-end items-center pb-4">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" id="table-search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Category Sub
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Image
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Link
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="product in products" :key="product.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="p-4 w-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ product.category_sub_id }}
                        </th>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ product.name }}
                        </th>
                        <td class="py-4 px-6">
                            <img :src="product.image" alt="" class="w-30 h-30">
                        </td>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <p class="text-gray-500 dark:text-gray-400"><a :href="product.link" target="_blank" class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Check the link
                                <svg aria-hidden="true" class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </p>
                        </th>
                        <td class="py-4 px-6">
                            <Link
                                class="text-green-500 hover:text-green-700 mr-6"
                                :href="route('product.edit', product.id)"
                            >
                            <i class="fa-solid fa-pen-to-square"></i>
                            </Link>
                            <el-button class="text-danger" text @click="open(product.id)"><i class="fa-solid fa-trash"></i></el-button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </Authenticated>
</div>
</template>


<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Authenticated from "@/Layouts/Authenticated.vue";

const
        props = defineProps({
            products: Object,
        }),

        open = (id) => {
            ElMessageBox.confirm('Are you sure?', 'Warning', {confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning',}
            )
                .then(() => {
                    Inertia.delete(route('product.destroy',{id}),{
                        onSuccess: response => { ElMessage({ message: 'Product has been successfully deleted.', type: 'success', });
                            Inertia.reload();
                        }
                    })
                })
        }

</script>

