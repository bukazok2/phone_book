<template>
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <div class="font-bold">Error!</div>
    <div class="block sm:inline">{{ errorMessage }}</div>
    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
      <svg @click="closeError" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849c-.439.44-1.146.44-1.586 0L10 11.414l-2.762 2.435c-.439.44-1.146.44-1.586 0-.439-.44-.439-1.147 0-1.587l2.763-2.434L5.05 6.35c-.439-.44-.439-1.147 0-1.587s1.146-.44 1.586 0l3.703 3.703L14.348 4.76c.439-.44 1.146-.44 1.586 0s.439 1.147 0 1.587L11.414 10l2.762 2.849c.439.44.439 1.146 0 1.587z"/></svg>
    </span>
  </div>
</template>

<script>
export default {
  props: {
    errorMessage: {
      type: String,
      required: true,
    },
  },
  methods: {
    closeError() {
      this.$emit('close');
    },
  },
};
</script>