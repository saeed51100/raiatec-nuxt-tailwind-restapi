<template>
  <section role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    <BlogGrid
        v-for="post in posts"
        :key="post.id"
        :title="post.title.rendered"
        :image="post._embedded['wp:featuredmedia'] ? post._embedded['wp:featuredmedia'][0].source_url : ' '"
        :excerpt="post.excerpt.rendered"
        :slug="post.slug"
    ></BlogGrid>
  </section>
</template>

<script lang="ts" setup>
import useWpApi from "~~/composables/useWpApi";

useHead({
  title: "Home",
  meta: [
    {
      name: "description",
      content: "Home",
    },
  ],
  titleTemplate: "raiatec - %s",
});
const {data: posts, refresh, error} = await useWpApi().getPosts();
</script>