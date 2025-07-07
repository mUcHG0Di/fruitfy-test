<script setup>
import { Link } from '@inertiajs/vue3';
import Pagination from '../../Components/Pagination.vue';

const props = defineProps({
  contacts: Object,
});
</script>

<template>
  <div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Contacts</h1>
                <Link :href="route('contacts.create')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg transition duration-150 ease-in-out flex items-center">
          <i class="mdi mdi-plus-circle mr-2"></i>
          Create Contact
        </Link>
      </div>

      <div v-if="$page.props.flash && $page.props.flash.success" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
        <p class="font-bold">Success</p>
        <p>{{ $page.props.flash.success }}</p>
      </div>

      <div class="bg-white shadow-2xl rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-4 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Name
              </th>
              <th class="px-6 py-4 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Email
              </th>
              <th class="px-6 py-4 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Phone
              </th>
              <th class="px-6 py-4 border-b-2 border-gray-200"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="contact in contacts.data" :key="contact.id" class="hover:bg-gray-50 transition duration-150 ease-in-out">
              <td class="px-6 py-4 whitespace-nowrap">
                <p class="text-sm text-gray-900">{{ contact.name }}</p>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <p class="text-sm text-gray-500">{{ contact.email }}</p>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <p class="text-sm text-gray-500">{{ contact.phone }}</p>
              </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex items-center justify-end space-x-4">
                  <Link :href="route('contacts.show', contact.id)" class="text-gray-500 hover:text-indigo-600" title="View">
                    <i class="mdi mdi-eye text-xl"></i>
                  </Link>
                  <Link :href="route('contacts.edit', contact.id)" class="text-gray-500 hover:text-yellow-600" title="Edit">
                    <i class="mdi mdi-pencil text-xl"></i>
                  </Link>
                  <Link :href="route('contacts.destroy', contact.id)" method="delete" as="button" type="button" class="text-gray-500 hover:text-red-600" :onBefore="() => confirm('Are you sure you want to delete this contact?')" title="Delete">
                    <i class="mdi mdi-delete text-xl"></i>
                  </Link>
                </div>
              </td>
            </tr>
            <tr v-if="contacts.data.length === 0">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center" colspan="4">
                    No contacts found.
                </td>
            </tr>
          </tbody>
        </table>
      </div>

            <!-- Pagination -->
      <Pagination :pagination="contacts.pagination" />

    </div>
  </div>
</template>
