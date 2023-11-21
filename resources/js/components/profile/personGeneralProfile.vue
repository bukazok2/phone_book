<template>
  <div class="bg-white rounded shadow-md text-left">
    <div v-if="person" class="flex items-center mb-4">
      <div class="w-12 h-12 overflow-hidden rounded-full mr-4">
        <img :src="'/storage/' + person.attachment" alt="Profile Picture" class="w-full h-full object-cover">
      </div>
      <div>
        <h2 class="text-xl font-bold">{{ person.name }}</h2>
        <p class="text-gray-700">Home: {{ person.home_address }}</p>
        <p class="text-gray-700">Mailing: {{ person.mailing_address }}</p>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ['person'],
};
</script>
