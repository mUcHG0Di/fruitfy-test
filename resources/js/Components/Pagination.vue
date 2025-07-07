<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  pagination: {
    type: Object,
    required: true,
  },
  links: {
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

const getPageUrl = (page) => {
  const url = new URL(props.links.first);
  url.searchParams.set('page', page);
  return url.toString();
};
</script>

<template>
  <div v-if="pagination.last_page > 1" class="mt-6 flex justify-center">
    <nav class="flex items-center space-x-1">
      <!-- Previous Page Link -->
      <Link
        :href="links.prev || '#!'"
        :class="['px-4 py-2 text-sm font-medium border rounded-md', links.prev ? 'text-gray-700 bg-white hover:bg-gray-50' : 'text-gray-400 bg-gray-50 cursor-not-allowed']"
        :disabled="!links.prev"
        as="button"
        type="button"
      >
        Previous
      </Link>

      <!-- Page Numbers -->
      <template v-for="page in pageNumbers" :key="page">
        <Link
          :href="getPageUrl(page)"
          :class="['px-4 py-2 text-sm font-medium border rounded-md', page === pagination.current_page ? 'text-white bg-indigo-600 border-indigo-600' : 'text-gray-700 bg-white hover:bg-gray-50']"
        >
          {{ page }}
        </Link>
      </template>

      <!-- Next Page Link -->
      <Link
        :href="links.next || '#!'"
        :class="['px-4 py-2 text-sm font-medium border rounded-md', links.next ? 'text-gray-700 bg-white hover:bg-gray-50' : 'text-gray-400 bg-gray-50 cursor-not-allowed']"
        :disabled="!links.next"
        as="button"
        type="button"
      >
        Next
      </Link>
    </nav>
  </div>
</template>
