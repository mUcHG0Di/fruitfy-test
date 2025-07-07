<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  phone: '',
});

const submit = () => {
  form.post(route('contacts.store'));
};
</script>

<template>
  <Head title="Create Contact" />

  <AuthenticatedLayout>
    <template #header />

    <div class="bg-gray-100 min-h-screen flex items-center justify-center">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-2xl">
        <div class="bg-white shadow-2xl rounded-lg overflow-hidden">
          <div class="px-8 py-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create New Contact</h1>

            <form @submit.prevent="submit">
              <div class="mb-5">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="name">
                  Name
                </label>
                <input v-model="form.name" class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" id="name" type="text" placeholder="John Doe">
                <p v-if="form.errors.name" class="text-red-500 text-xs italic mt-2">{{ form.errors.name }}</p>
              </div>

              <div class="mb-5">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                  Email
                </label>
                <input v-model="form.email" class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" id="email" type="email" placeholder="john.doe@example.com">
                <p v-if="form.errors.email" class="text-red-500 text-xs italic mt-2">{{ form.errors.email }}</p>
              </div>

              <div class="mb-8">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="phone">
                  Phone
                </label>
                <input v-model="form.phone" class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" id="phone" type="text" placeholder="(123) 456-7890">
                <p v-if="form.errors.phone" class="text-red-500 text-xs italic mt-2">{{ form.errors.phone }}</p>
              </div>

              <div class="flex items-center justify-end gap-4">
                <Link :href="route('contacts.index')" class="text-gray-600 hover:text-gray-800 font-medium py-2 px-4 rounded">
                  Back
                </Link>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out flex items-center disabled:opacity-50" type="submit" :disabled="form.processing">
                  <span v-if="form.processing" class="mdi mdi-loading mdi-spin mr-2"></span>
                  {{ form.processing ? 'Creating...' : 'Create Contact' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
