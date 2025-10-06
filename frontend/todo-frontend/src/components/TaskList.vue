<template>
  <div class="task-list">
    <div
        class="task-card"
        v-for="task in tasks"
        :key="task.id"
        :class="task.is_completed == 1 ? 'completed' : 'pending'"
    >
      <div class="task-content">
        <h3>{{ task.title }}</h3>
        <p>{{ task.description }}</p>
      </div>
      <button
          v-if="task.is_completed == 0"
          class="done-btn"
          @click="$emit('done-task', task.id)"
      >
        Done
      </button>
    </div>

    <p v-if="tasks.length === 0" class="no-tasks">No tasks found</p>
  </div>
</template>

<script>
export default {
  props: ["tasks"],
};
</script>

<style scoped>
.task-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.task-card {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 20px;
  border-radius: 18px;
  color: #fff;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: transform 0.2s ease;
}

.task-card:hover {
  transform: translateY(-5px);
}

.pending {
  background: rgba(255, 255, 255, 0.2);
}

.completed {
  background: rgba(0, 255, 127, 0.2);
  text-decoration: line-through;
}

.done-btn {
  padding: 8px 14px;
  border: none;
  border-radius: 12px;
  background: #ff6b6b;
  color: #fff;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s;
}

.done-btn:hover {
  background: #e85c5c;
}

.no-tasks {
  text-align: center;
  color: #fff;
  margin-top: 15px;
  font-style: italic;
}
</style>
