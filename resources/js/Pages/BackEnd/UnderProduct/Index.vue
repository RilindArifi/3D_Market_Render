<template>
<div>
    <Head title="Under Product" />
    <Dashboard>
    <div class="flex justify-end">
        <Link :href="route('underproduct.create')" class="bg-gradient-fuchsia inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-size-xs bg-150 active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 border-fuchsia-500 text-white hover:opacity-75">+ Add Under Product</Link>
    </div>
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Under Product</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <!-- <TableCategory></TableCategory> -->
                        <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase"
                                >
                                    ID
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase"
                                >
                                    Category
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase"
                                >
                                    Product
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase"
                                >
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                    Image
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase"
                                >
                                    Edit
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase"
                                >
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="underproducts in underproduct">
                                <td
                                    class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap"
                                >
                                    {{ underproducts.id }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap"
                                >
                                    {{ underproducts.category_id  }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap"
                                >
                                    {{ underproducts.product_id }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap"
                                >
                                    {{ underproducts.name }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap"
                                >
                                    <img :src="underproducts.image" alt="" class="w-30 h-30">
                                </td>
                                <td class="py-4 px-6">
                                    <Link
                                        class="text-green-500 hover:text-green-700 mr-6"
                                        :href="route('underproduct.edit', underproducts.id)"
                                    >
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </Link>
                                    <el-button class="text-danger" text @click="open(underproducts.id)"><i class="fa-solid fa-trash"></i></el-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

</Dashboard>
</div>
</template>


<script setup>
import Dashboard from '@/Layouts/Dashboard.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";

const
    props = defineProps({
        underproduct: Object,
    }),

    open = (id) => {
        ElMessageBox.confirm(
            'Are you sure?',
            'Warning',
            {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning',
            }
        )
            .then(() => {
                Inertia.delete(route('underproduct.destroy',{id}),{
                    onSuccess: response => {
                        ElMessage({
                            message: 'Under product has been successfully deleted.',
                            type: 'success',
                        });
                        Inertia.reload();
                    },
                    onError: error => {
                        ElMessage({
                            message: 'Something went wrong',
                            type: 'warning',
                        });
                        Inertia.reload();
                    }

                })
            })
            .catch(() => {
                ElMessage({
                    type: 'info',
                    message: 'Delete canceled',
                })
            })
    }

</script>

