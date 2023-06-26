<template>
  <Define
      v-for="post in posts"
      :key="post.id"
      :title="post.title.rendered"
      :slug="post.slug"
  ></Define>

</template>

<script setup lang="ts">
import useWpApi from "~~/composables/useWpApi";

import Define from "~/components/ListOfPosts/Define.vue";
const {data: posts, refresh, error} = await useWpApi().getPosts();

</script>