<template>
  <div>
    <Actions />
    <PersonTable :persons="persons" @postSentSuccessfully="fetchData" />
  </div>
</template>

<script>
import axios from 'axios';
import PersonTable from './personTable.vue';
import Actions from './actions.vue';

export default {
  data() {
    return {
      persons: [],
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        const response = await axios.get('http://localhost:8000/api/Persons');
        this.persons = response.data.persons;
        console.log(this.persons);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
  },
  components: {
    PersonTable,
    Actions
  },
};
</script>
