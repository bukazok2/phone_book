<template>
  <div>
    <Error v-if="error" :errorMessage="error" @close="clearError" />
    <div v-if="person">
         <PersonGeneralProfile :person="person" />
        <div class="flex">
            <div class="w-1/2 mr-4">
             <PersonAdditionalInfo :person-info="person.emails" :person-info-type="'email'" :field="'Email'" @dataInsertedSuccessfully="fetchPersonData" @error="handleError" />
            </div>
            <div class="w-1/2">
            <PersonAdditionalInfo :person-info="person.phones" :person-info-type="'phone_number'" :field="'Phone number'" @dataInsertedSuccessfully="fetchPersonData" @error="handleError"/>
            </div>
        </div>
    </div>
    <div v-else>
      <p>Loading...</p>
    </div>
    <router-link to="/">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-5 rounded">
      Back
    </button>
  </router-link>
  </div>
</template>

<script>
import axios from 'axios';
import PersonGeneralProfile from './personGeneralProfile.vue';
import PersonAdditionalInfo from './personAdditionalInfo.vue';
import Error from '../error.vue';

export default {
  props: ['id'],
  data() {
    return {
      error: null,
      person: null,
    };
  },
  mounted() {
    this.fetchPersonData();
  },
  methods: {
    clearError(){
      this.error = null;
    },
    handleError(errorMessage) {
      this.error = errorMessage;
    },
    async fetchPersonData() {
      try {
        const response = await axios.get(`/api/Person/${this.id}`);
        this.person = response.data.person;
        console.log(this.person);
      } catch (error) {
        console.error('Error fetching person data:', error);
      }
    },
  },
  components: {
    PersonGeneralProfile,
    PersonAdditionalInfo,
    Error
  },
};
</script>
