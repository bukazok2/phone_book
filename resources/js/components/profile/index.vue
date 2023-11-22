<template>
  <div>
    <div v-if="person">
         <PersonGeneralProfile :person="person" />
        <div class="flex">
            <div class="w-1/2 mr-4">
             <PersonAdditionalInfo :person-info="person.emails" :person-info-type="'emails'" @dataInsertedSuccessfully="fetchPersonData" />
            </div>
            <div class="w-1/2">
            <PersonAdditionalInfo :person-info="person.phones" :person-info-type="'phones'" @dataInsertedSuccessfully="fetchPersonData"/>
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

export default {
  props: ['id'],
  data() {
    return {
      person: null,
    };
  },
  mounted() {
    this.fetchPersonData();
  },
  methods: {
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
  },
};
</script>
