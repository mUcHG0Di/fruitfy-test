<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  contact: Object,
});
</script>

<template>
  <div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-2xl">
      <div class="bg-white shadow-2xl rounded-lg overflow-hidden">
        <div class="px-8 py-10">
          <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">{{ contact.data.name }}</h1>
            <p class="text-lg text-gray-500 mt-2">{{ contact.data.email }}</p>
          </div>

          <div class="border-t border-gray-200 pt-6">
            <dl>
              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ contact.data.phone }}</dd>
              </div>
            </dl>
          </div>
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-200 flex justify-end items-center gap-4">
          <Link :href="route('contacts.index')" class="text-gray-600 hover:text-gray-800 font-medium py-2 px-4 rounded">
            Back
          </Link>
          <Link :href="route('contacts.edit', contact.data.id)" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
            Edit Contact
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
