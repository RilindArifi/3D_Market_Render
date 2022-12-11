<template>
    <Head title="Update Category" />
    <Dashboard>
      <div class="flex justify-end">
      <Link :href="route('category.index')"
        class="bg-gradient-fuchsia inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-size-xs bg-150 active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 border-fuchsia-500 text-white hover:opacity-75">
      Back
      </Link>
    </div>
      <div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="mt-5 md:col-span-2 md:mt-0">
            <form @submit.prevent="onSubmit">
              <div class="shadow sm:overflow-hidden sm:rounded-md">
                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                  <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                      <label for="first-name" class="block text-sm font-medium text-gray-700">Category name</label>
                      <input type="text" v-model="form.name" name="name" id="name" autocomplete="given-name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        <div class="text-red-600">
                            {{ errors.name }}
                        </div>
                    </div>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Cover photo</label>
                    <div
                      class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                      <div class="space-y-1 text-center">
                        <div class="flex text-sm text-gray-600">
                            <input @input="form.image = $event.target.files[0]"  class="block mb-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="default_size" type="file">
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
    </Dashboard>
  </template>

  <script setup>
  import Dashboard from '@/Layouts/Dashboard.vue';
  import { Head, useForm } from '@inertiajs/inertia-vue3';
  import { Inertia } from '@inertiajs/inertia';

  const
      props = defineProps({
            category: Object,
            image: String,
            errors: Object
        }),

        form = useForm({
            name: props.category.name,
            image: null,
        }),

       onSubmit = () => {
           Inertia.post(route('category.update', props.category.id), {
               _method: "put",
               name: form.name,
               image: form.image
           }, {
               onSuccess: response => {
                   ElMessage({
                       message: 'Category has been successfully updated.',
                       type: 'success',
                   });
                   Inertia.reload();
               }
           })
       }

  </script>
