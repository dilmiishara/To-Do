<template>
  <div class="app-container">
    <h1>
      <span class="typed-text">{{ displayedText }}</span>
      <span v-if="showCursor" class="cursor">|</span>
    </h1>

    <!-- Tabs -->
    <div class="tabs">
      <button
          v-for="tab in tabs"
          :key="tab"
          :class="{ active: activeTab === tab }"
          @click="activeTab = tab"
      >
        {{ tab }}
      </button>
    </div>

    <!-- Add Tab -->
    <div v-if="activeTab === 'Add'">
      <TaskForm @add-task="addTask" />
    </div>

    <!-- All Tab -->
    <div v-if="activeTab === 'All'">
      <TaskList :tasks="tasks" @done-task="markAsDone" />
    </div>

    <!-- Pending Tab -->
    <div v-if="activeTab === 'Pending'">
      <TaskList
          :tasks="tasks.filter(t => t.is_completed == 0)"
          @done-task="markAsDone"
      />
    </div>

    <!-- Completed Tab -->
    <div v-if="activeTab === 'Completed'">
      <TaskList :tasks="tasks.filter(t => t.is_completed == 1)" />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import TaskForm from "./components/TaskForm.vue";
import TaskList from "./components/TaskList.vue";

export default {
  components: { TaskForm, TaskList },
  data() {
    return {
      tasks: [],
      tabs: ["Add", "All", "Pending", "Completed"],
      activeTab: "Add",
      fullText: "JUST DO IT",
      displayedText: "",
      typingSpeed: 400,
      showCursor: true,
    };
  },
  methods: {
    async fetchTasks() {
      const res = await axios.get("http://localhost:8000/api/get.php");
      this.tasks = res.data;
    },
    async addTask(task) {
      await axios.post("http://localhost:8000/api/create.php", task);
      this.fetchTasks();
      this.activeTab = "All";
    },
    async markAsDone(id) {
      await axios.put("http://localhost:8000/api/update.php", { id });
      this.fetchTasks();
    },
    typeTitle() {
      let index = 0;
      const typeInterval = setInterval(() => {
        if (index < this.fullText.length) {
          this.displayedText += this.fullText[index];
          index++;
        } else {
          clearInterval(typeInterval);
          this.showCursor = false;
        }
      }, this.typingSpeed);
    },
  },
  mounted() {
    this.fetchTasks();
    this.typeTitle(); // Start typing animation when mounted
  },
};

</script>

<style>
body {
  font-family: "Poppins", sans-serif;
  background: url('@/assets/bg.jpg') no-repeat center center fixed;
  background-size: cover;
  margin: 0;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  overflow: hidden;
}


.app-container {
  width: 800px;
  height: 600px;
  margin: 40px auto;
  padding: 30px;
  background: rgba(255, 255, 255, 0.15);
  border-radius: 25px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  overflow-y: auto;
}

/* Scrollbar styling for .app-container */
.app-container::-webkit-scrollbar {
  width: 8px;               /* Thin scrollbar */
}

.app-container::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);  /* Transparent background */
  border-radius: 10px;
}

.app-container::-webkit-scrollbar-thumb {
  background: rgba(66, 185, 131, 0.6);   /* Greenish accent */
  border-radius: 10px;
  transition: background 0.3s;
}

.app-container::-webkit-scrollbar-thumb:hover {
  background: rgba(66, 185, 131, 0.9);   /* Brighter when hovered */
}

/* Optional for Firefox */
.app-container {
  scrollbar-width: thin;
  scrollbar-color: rgba(66, 185, 131, 0.6) rgba(255, 255, 255, 0.1);
}



h1 {
  text-align: center;
  color: #fff;
  margin-bottom: 25px;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

/* Tabs */
.tabs {
  display: flex;
  justify-content: space-around;
  margin-bottom: 25px;
  border-bottom: 2px solid rgba(255, 255, 255, 0.3);
}

.tabs button {
  background: none;
  border: none;
  padding: 10px 30px;
  font-size: 16px;
  color: #eee;
  cursor: pointer;
  transition: 0.3s;
  border-bottom: 3px solid transparent;
}

.tabs button:hover {
  color: #42b983;
}

.tabs .active {
  color: #42b983;
  border-bottom: 3px solid #42b983;
}
</style>
