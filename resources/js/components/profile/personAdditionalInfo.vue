<template>
  <table class="min-w-full bg-white border border-gray-300">
      <thead>
        <tr>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Email</th>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Phone Number</th>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="p in person.personal_info" :key="p.id">
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">{{ p.email }}</td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">{{ p.phone_number }}</td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
            <span class="cursor-pointer" @click="editPerson(p.id)">
              <font-awesome-icon icon="edit" />
            </span>
            <span class="cursor-pointer ml-2" @click="deletePerson(p.id)">
               <font-awesome-icon icon="trash-can" />
            </span>
          </td>
        </tr>
      </tbody>
    </table>
</template>

<script>
export default {
  props: ['person'],
};
</script>
