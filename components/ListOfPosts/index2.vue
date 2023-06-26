<template>
  <div
      v-for="post in posts"
      :key="post.id"
      :title="post.title.rendered"
      :slug="post.slug"
  >
    <!--    <NuxtLink v-if="slug" :to="`/${slug}`">{{ title }}</NuxtLink>-->
    <NuxtLink v-if="slug" :to="`/${slug}`">{{ post.title.rendered }}</NuxtLink>

  </div>

</template>

<script setup lang="ts">
import useWpApi from "~~/composables/useWpApi";


const {data: posts, refresh, error} = await useWpApi().getPosts();


let title: string;
let slug: string;

</script>