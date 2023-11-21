<template>
  <div>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Home address</th>
          <th>Mailing address</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="person in persons" :key="person.id">
          <td>{{ person.id }}</td>
          <td>{{ person.name }}</td>
          <td>{{ person.home_address }}</td>
          <td>{{ person.mailing_address }}</td>
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
