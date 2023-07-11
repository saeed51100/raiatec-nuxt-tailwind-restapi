<template>

  <div v-for="category in categories" :key="(category ).id" class="bg-red-200">
    {{ (category).name }}
  </div>

  <div v-for="post in posts " :key="post.id">
    <NuxtLink v-if="post.slug" :to="`/${post.slug}`" @click="$emit('close-modal')">{{ post.title.rendered }}</NuxtLink>
  </div>

</template>

<script setup lang="ts">
const {data: posts, error} = await useWpApi().getPosts();
const {data: categories} = await useWpApi().getCatgories();
</script>