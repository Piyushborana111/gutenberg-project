<template>
  <div>
    <h2>Example Component</h2>
    <p>{{ message }}</p>
  </div>
</template>

<script setup>
import { ref } from 'vue'
const message = ref('Hello from Vue 3 + Laravel!')
</script>
