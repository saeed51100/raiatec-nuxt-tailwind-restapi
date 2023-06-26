<template>
  <div
      v-for="post in posts"
      :key="post.id"
      :title="post.title.rendered"
      :slug="post.slug"
  >
    <NuxtLink v-if="post.slug" :to="`/${post.slug}`">{{ post.title.rendered }}</NuxtLink>

  </div>

</template>

<script setup lang="ts">
import useWpApi from "~~/composables/useWpApi";

const {data: posts, error} = await useWpApi().getPosts();

</script>