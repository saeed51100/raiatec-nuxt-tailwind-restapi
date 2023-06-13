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
const { data: posts, refresh, error } = await useWpApi().getPosts();
</script>
<template>
  <main>

    <!-- Blog Section Starts -->
    <section class="blogs">
      <div class="container py-10">
        <div class="grid sm:grid-cols-3 gap-10">
          <BlogGrid
            v-for="post in posts"
            :key="post.id"
            :title="post.title.rendered"
            :image="post._embedded['wp:featuredmedia'] ? post._embedded['wp:featuredmedia'][0].source_url : ' '"
            :excerpt="post.excerpt.rendered"
            :slug="post.slug"
          ></BlogGrid>
        </div>
      </div>
    </section>
    <!-- Blog Section Ends  -->
  </main>
</template>

<style>
.hero__title {
  @apply text-4xl font-bold;
}
.hero__des {
  @apply text-xl;
}
</style>
