<template>

  <div v-for="post in posts " :key="post.id">
    <div >{{ post.title.rendered }}</div>
  </div>

</template>

<script setup lang="ts">
const {data: posts, error} = await useWpApi().getPosts();

</script>