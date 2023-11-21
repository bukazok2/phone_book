<template>
  <div>
    <h2>Person Details</h2>
    <table>
      <tr>
        <th>Name</th>
        <td>{{ person.name }}</td>
      </tr>
      <tr>
        <th>Age</th>
        <td>{{ person.maling_address }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    person: {
      type: Object,
      required: true,
    },
  },
};
</script>
