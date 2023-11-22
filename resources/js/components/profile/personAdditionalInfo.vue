<template>
  <div>
    <table class="min-w-full bg-white border border-gray-300">
      <thead>
        <tr>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">{{ fieldLabel }}</th>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="info in personInfo" :key="info.id">
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">{{ displayField(info) }}</td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
             <span class="cursor-pointer" @click="editPerson(person.id)">
              <font-awesome-icon icon="edit" />
          </span>
          <span class="cursor-pointer ml-2">
              <font-awesome-icon icon="trash-can" />
          </span>
          </td>
        </tr>
        
        <tr v-if="isAddingRow">
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
            <input v-model="newRow.fieldVal" type="text" class="border rounded p-2">
          </td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
            <button @click="saveNewRow" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
          </td>
        </tr>
      </tbody>
    </table>

    <button @click="addNewRow" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add New Row</button>
  </div>
</template>

<script>

import axios from 'axios';

export default {
  props: ['personInfo', 'personInfoType'],
  data() {
    return {
      isAddingRow: false,
      newRow: {
        id: 0,
        fieldVal: '',
      },
    };
  },
  computed: {
    fieldLabel() {
      return this.personInfoType === 'emails' ? 'Email' : 'Phone';
    },
  },
  methods: {
    addNewRow() {
      this.isAddingRow = true;
    },
    saveNewRow() {
      const requestData = {
        person_id: this.$route.params.id,
        phone_number: this.newRow.fieldVal,
      };

      axios.post('/api/add-new-phone', requestData)
        .then(response => {
          console.log('Phone number added successfully', response.data);

          this.isAddingRow = false;
          this.newRow = {
            id: 0,
            fieldVal: '',
          };

          this.$emit('dataInsertedSuccessfully');
        })
        .catch(error => {
          console.error('Error adding phone number', error);
      });
    },
    displayField(personalInfo) {
      return this.personInfoType === 'emails' ? personalInfo.email : personalInfo.phone_number;
    },
  },
};
</script>