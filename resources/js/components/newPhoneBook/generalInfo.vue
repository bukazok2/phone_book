<template>
<Error v-if="error" :errorMessage="error" @close="clearError" />
  <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded shadow-md">
    
    <div v-if="attachment" class="w-12 h-12 overflow-hidden rounded-full mr-4">
        <img :src="'/storage/' + attachment" alt="Profile Picture" class="w-full h-full object-cover">
    </div>
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
import Error from '../error.vue';

export default {
  components: {
    Error,
  },
  data() {
    return {
      error : null,
      formData: {
        name: '',
        attachment: null,
        home_address: '',
        mailing_address: '',
      },
      attachment: '',
      fillMailingAddress: false,
    };
  },
  methods: {
    clearError(){
      this.error = null;
    },
    async submitForm() {
      let response;
      try {
        const formDataToSend = new FormData();
        formDataToSend.append('name', this.formData.name);
        formDataToSend.append('home_address', this.formData.home_address);
        formDataToSend.append('mailing_address', this.formData.mailing_address);

        if (this.formData.attachment) {
          formDataToSend.append('attachment', this.formData.attachment);
        }

        
        if (!this.$route.params.id) {
          response = await axios.post('/api/add-new-person', formDataToSend, {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          });
        } else {
          response = await axios.post(`/api/edit-person/${this.$route.params.id}`, formDataToSend, {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          });
        }
        this.error = response.message;
        this.$router.push({ name: 'profile', params: { id: response.data.person.id } });

      } catch (error) {
        this.error = error.response.data.message;
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
  async created() {
    if (this.$route.params.id) {
      try {
        const response = await axios.get(`/api/Person/${this.$route.params.id}`);
        console.log(response);
        this.formData.name = response.data.person.name;
        this.formData.home_address = response.data.person.home_address;
        this.formData.mailing_address = response.data.person.mailing_address;
        this.attachment = response.data.person.attachment;
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    }
  }

};
</script>
