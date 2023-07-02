<template>
  <div>
    <ul>
      <li v-for="post in nonCategorizedPosts" :key="post.id" :style="{ marginTop: '5px', listStyleType: 'none' }">
        <nuxt-link :to="post.link" :class="{ 'list-group': post.id === currentId && isSingle }">
          {{ post.title.rendered }}
        </nuxt-link>
      </li>
    </ul>

    <div v-for="category in categories" :key="category.id">
      <h5 class="cat-title bg-info">{{ category.name }}</h5>
      <div class="cat-content">
        <ul>
          <li v-for="post in category.posts" :key="post.id" :style="{ marginTop: '5px', listStyleType: 'none' }">
            <nuxt-link :to="post.link" :class="{ 'list-group': post.id === currentId && isSingle }">
              {{ post.title.rendered }}
            </nuxt-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import useWpApi from '~/composables/useWpApi';

const { data: posts } = await useWpApi().getPosts();
const { data: categories } = await useWpApi().getCatgories();

const currentId = ref(null); // Set the current ID
const isSingle = ref(false); // Set the single flag

const nonCategorizedPosts = computed(() => {
  return posts.value.filter((post) => !post.categories.length);
});

categories.value.forEach((category) => {
  category.posts = posts.value.filter((post) =>
      post.categories.includes(category.id)
  );
});
</script>