<template>
  <div v-for="post in posts " :key="post.id">
    <NuxtLink v-if="post.slug" :to="`/${post.slug}`">{{ post.title.rendered }}</NuxtLink>
  </div>
</template>

<script setup lang="ts">
const {data: posts, error} = await useWpApi().getPosts();
</script>