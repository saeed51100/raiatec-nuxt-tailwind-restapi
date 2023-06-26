<template>

  <div v-for="post in posts">
    <NuxtLink v-if="post.slug" :to="`/${post.slug}`">{{ post.title.rendered }}</NuxtLink>
  </div>

</template>

<script setup lang="ts">
import useWpApi from "~~/composables/useWpApi";

const {data: posts, error} = await useWpApi().getPosts();

</script>