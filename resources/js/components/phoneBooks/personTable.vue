<template>
  <div>
    <table class="min-w-full bg-white border border-gray-300">
      <thead>
        <tr>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">ID</th>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Name</th>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Home Address</th>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Mailing Address</th>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="person in persons" :key="person.id">
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">{{ person.id }}</td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">{{ person.name }}</td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">{{ person.home_address }}</td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">{{ person.mailing_address }}</td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
          <span class="cursor-pointer" @click="editPerson(person.id)">
              <font-awesome-icon icon="edit" />
          </span>
          <span class="cursor-pointer ml-2">
              <font-awesome-icon icon="trash-can" />
          </span>
          <span class="cursor-pointer ml-2">
            <router-link :to="`/profile/${person.id}`">
              <font-awesome-icon icon="eye" />
            </router-link>
          </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>



<script>
export default {
  props: {
    persons: {
      type: Array,
      default: () => [],
    },
  },
};
</script>
