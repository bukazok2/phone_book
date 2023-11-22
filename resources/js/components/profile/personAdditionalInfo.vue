<template>
  <div>
    <table class="min-w-full bg-white border border-gray-300">
      <thead>
        <tr>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">{{ field }}</th>
          <th class="px-6 py-3 bg-gray-100 border-b text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="info in personInfo" :key="info.id">
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
            <span v-if="editMode && editId === info.id">
              <input v-model="updatedFieldVal" type="text" class="border rounded p-2">
            </span>
            <span v-else>
              {{ displayField(info) }}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap border-b text-center">
            <span v-if="editMode && editId === info.id">
              <button @click="updateRow(info.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
            </span>
            <span v-else>
               <span class="cursor-pointer" @click="editField(info.id)">
                <font-awesome-icon icon="edit" />
              </span>
              <span class="cursor-pointer ml-2" @click="deleteField(info.id)">
                <font-awesome-icon icon="trash-can" />
              </span>
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
  props: ['personInfo', 'personInfoType', 'field'],
  data() {
    return {
      isAddingRow: false,
      editMode:false,
      editId: 0,
      updatedFieldVal: '',
      newRow: {
        id: 0,
        fieldVal: '',
      },
    };
  },
  methods: {
    addNewRow() {
      this.isAddingRow = true;
    },
    saveNewRow() {
      const requestData = {
        person_id: this.$route.params.id,
        [this.personInfoType]: this.newRow.fieldVal,
      };

      axios.post(`/api/add-new-${this.personInfoType}`, requestData)
        .then(response => {
          console.log(`${this.personInfoType} added successfully`, response.data);
          this.requestSuccess();
        })
        .catch(error => {
          this.$emit('error', error.response.data.message);
        });
    },
    requestSuccess(){
      this.isAddingRow = false;
      this.newRow = {
        id: 0,
        fieldVal: '',
      };
      this.editId = 0;
      this.editMode = false;
      this.updatedFieldVal = "";
      this.$emit('dataInsertedSuccessfully');
    },
    displayField(personalInfo) {
       return personalInfo[this.personInfoType];
    },
    deleteField(id) {
      const deleteEndpoint = `/api/delete-${this.personInfoType}/${id}`;

      axios.post(deleteEndpoint, {_method: 'DELETE'})
        .then(response => {
          console.log(`${this.personInfoType} deleted successfully`, response.data);
          this.requestSuccess();
        })
        .catch(error => {
          this.$emit('error', error.response.data.message);
        });
    },
    editField(id) {
      this.editId = id;
      this.editMode = true;
      const index = this.personInfo.findIndex(info => info.id === id);
      this.updatedFieldVal = this.personInfo[index][this.personInfoType];
    },
    updateRow(id) {
      const requestData = {
        [this.personInfoType]: this.updatedFieldVal,
        person_id: this.$route.params.id,
      };

      axios.put(`/api/edit-${this.personInfoType}/${id}`, requestData)
        .then(response => {
          this.requestSuccess();
        })
        .catch(error => {
          this.$emit('error', error.response.data.message);
        });
    },
  },
};
</script>
