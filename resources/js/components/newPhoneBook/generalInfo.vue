<template>
  <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded shadow-md">
    <form @submit.prevent="submitForm">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Name:
        </label>
        <input
          v-model="formData.name"
          id="name"
          type="text"
          class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        />
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="attachment">
          Attachment (Upload Picture):
        </label>
        <input
          type="file"
          id="attachment"
          class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          @change="handleFileChange"
        />
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="home_address">
          Home Address:
        </label>
        <input
          v-model="formData.home_address"
          id="home_address"
          type="text"
          class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        />
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="mailing_address">
          Mailing Address:
        </label>
        <input
          v-model="formData.mailing_address"
          id="mailing_address"
          type="text"
          class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        />
      </div>

      <div class="mb-4">
        <input
          v-model="fillMailingAddress"
          id="fill_mailing_address"
          type="checkbox"
          class="mr-2 leading-tight"
        />
        <label class="text-gray-700 text-sm font-bold" for="fill_mailing_address">
          home address and mailing address is the same
        </label>
      </div>
      
      <button
        type="submit"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
      >
        Submit
      </button>

       <router-link to="/">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4">
          back
        </button>
      </router-link>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      formData: {
        name: '',
        attachment: null,
        home_address: '',
        mailing_address: '',
      },
      fillMailingAddress: false,
    };
  },
  methods: {
    async submitForm() {
      try {
        const formData = new FormData();
        formData.append('name', this.formData.name);
        formData.append('home_address', this.formData.home_address);
        formData.append('mailing_address', this.formData.mailing_address);
        formData.append('fillMailingAddress', this.fillMailingAddress);

        if (this.formData.attachment) {
          formData.append('attachment', this.formData.attachment);
        }

        const response = await axios.post('/api/add-new-person', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        this.$router.push({ name: 'profile', params: { id: response.data.person.id } });

      } catch (error) {
        console.error('Error submitting data:', error);
      }
    },
    handleFileChange(event) {
      const file = event.target.files[0];
      this.formData.attachment = file;
    },
  },
  watch: {
    'formData.home_address'(newVal) {
      if (this.fillMailingAddress) {
        this.formData.mailing_address = newVal;
      }
    },
  },
};
</script>
