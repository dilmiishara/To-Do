<template>
  <form @submit.prevent="$emit('add-task', task)">
    <input v-model="task.title" placeholder="Task title" required />
    <textarea v-model="task.description" placeholder="Description" required></textarea>
    <button type="submit">Add Task</button>
  </form>
</template>

<script>
export default {
  data() {
    return {task: {title: "", description: ""}};
  },
};
</script>

<style scoped>
form {
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-bottom: 25px;
}

input,
textarea {
  padding: 12px 15px;
  border-radius: 15px;
  border: none;
  background: rgba(255, 255, 255, 0.25);
  color: rgba(0, 0, 0, 0.47);
  font-size: 14px;
  outline: none;
  backdrop-filter: blur(5px);
}

::placeholder {
  color: #ffffff;
}

button {
  padding: 12px;
  border: none;
  border-radius: 15px;
  background: #42b983;
  color: #fff;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

button:hover {
  background: #369a6d;
}
</style>
