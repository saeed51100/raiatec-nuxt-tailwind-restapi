<template>
  <h1>
    {{ post.title.rendered }}
  </h1>
</template>

<script setup lang="ts">
const {data: posts, error} = await useWpApi().getPosts();
</script>