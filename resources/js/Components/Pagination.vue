<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  pagination: {
    type: Object,
    required: true,
  },
});

const pageNumbers = computed(() => {
  const pages = [];
  for (let i = 1; i <= props.pagination.last_page; i++) {
    pages.push(i);
  }
  return pages;
});
</script>

<template>
  <div v-if="pagination.last_page > 1" class="mt-6 flex justify-center">
    <nav class="flex items-center space-x-1">
      <!-- Previous Page Link -->
      <Link
        :href="pagination.current_page > 1 ? route(route().current(), { page: pagination.current_page - 1 }) : '#!'"
        :class="['px-4 py-2 text-sm font-medium border rounded-md', pagination.current_page > 1 ? 'text-gray-700 bg-white hover:bg-gray-50' : 'text-gray-400 bg-gray-50 cursor-not-allowed']"
        :disabled="pagination.current_page <= 1"
        as="button"
        type="button"
      >
        Previous
      </Link>

      <!-- Page Numbers -->
      <template v-for="page in pageNumbers" :key="page">
        <Link
          :href="route(route().current(), { page: page })"
          :class="['px-4 py-2 text-sm font-medium border rounded-md', page === pagination.current_page ? 'text-white bg-indigo-600 border-indigo-600' : 'text-gray-700 bg-white hover:bg-gray-50']"
        >
          {{ page }}
        </Link>
      </template>

      <!-- Next Page Link -->
      <Link
        :href="pagination.current_page < pagination.last_page ? route(route().current(), { page: pagination.current_page + 1 }) : '#!'"
        :class="['px-4 py-2 text-sm font-medium border rounded-md', pagination.current_page < pagination.last_page ? 'text-gray-700 bg-white hover:bg-gray-50' : 'text-gray-400 bg-gray-50 cursor-not-allowed']"
        :disabled="pagination.current_page >= pagination.last_page"
        as="button"
        type="button"
      >
        Next
      </Link>
    </nav>
  </div>
</template>
