<template>
  <div>
    <table class="min-w-full bg-white border border-gray-300">
      <!-- ... existing table header ... -->
      <thead>
        <tr>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Email</th>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Phone Number</th>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- ... existing rows ... -->
        <tr v-for="p in person.personal_info" :key="p.id">
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">{{ p.email }}</td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">{{ p.phone_number }}</td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
            <!-- ... existing actions ... -->
          </td>
        </tr>

        <!-- New row with input fields -->
        <tr v-if="isAddingRow">
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
            <input v-model="newRow.email" type="text" class="border rounded p-2">
          </td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
            <input v-model="newRow.phone_number" type="text" class="border rounded p-2">
          </td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
            <button @click="saveNewRow" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Button to add a new row -->
    <button @click="addNewRow" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add New Row</button>
  </div>
</template>

<script>
export default {
  props: ['person'],
  data() {
    return {
      isAddingRow: false,
      newRow: {
        id: 0,
        email: '',
        phone_number: '',
      },
    };
  },
  methods: {
    addNewRow() {
      this.isAddingRow = true;
    },
    saveNewRow() {
      
      this.isAddingRow = false;
      this.newRow = {
        id: 0,
        email: '',
        phone_number: '',
      };
    },
  },
};
</script>
