In the nuxt 3 program, using the following code, I have
shown the list of posts and categories in the sidebar:

<template>
  <div>
    <div v-for="post in posts" :key="post.id">
      <!-- show post.title if exists in concatenatedTitles else execute new logic -->
      <template v-if="concatenatedTitles.includes(post.title.rendered)">
        <nuxt-link :to="`/${post.slug}`" @click="$emit('close-modal')" :key="post.slug">
          {{ post.title.rendered }}
        </nuxt-link>
      </template>
      <template v-else>
        <!-- categorized posts -->
        <div v-for="category in categories" :key="category.id">
          <template v-if="post.categories.includes(category.id) && !isCategoryRepeated(category.name)">
            <h3 class="bg-red-200">{{ category.name }}</h3>
            <ul>
              <li v-for="relatedPost in category.posts.slice().reverse()" :key="relatedPost.id">
                <nuxt-link :to="`/${relatedPost.slug}`" @click="$emit('close-modal')" :key="relatedPost.slug">
                  {{ relatedPost.title.rendered }}
                </nuxt-link>
              </li>
            </ul>
          </template>
        </div>
      </template>
    </div>
  </div>
</template>

<script setup lang="ts">
import {ref, computed} from 'vue';
import useWpApi from '~/composables/useWpApi';

const {data: posts} = await useWpApi().getPosts();
const {data: categories} = await useWpApi().getCatgories();

// Initialize an array to store concatenated titles
const concatenatedTitles = ref([]);

const nonCategorizedPosts = computed(() => {
  return posts.value?.filter(post => !post.categories.length);
});

// Add post titles into the 'concatenatedTitles' array
nonCategorizedPosts.value?.forEach(post => {
  concatenatedTitles.value.push(post.title.rendered);
});

categories.value.forEach(category => {
  category.posts = posts.value?.filter(post =>
      post.categories.includes(category.id)
  );
});

// Computed property to check if category name is repeated
const isCategoryRepeated = computed(() => {
  const uniqueCategories = new Set();
  return (categoryName: string) => {
    if (uniqueCategories.has(categoryName)) {
      return true; // Category name is repeated
    } else {
      uniqueCategories.add(categoryName);
      return false; // Category name is not repeated
    }
  };
});
</script>



But the problem is that when clicking on the home button, the list of posts
is not update correctly and I have to refresh the browser so that the sidebar
is displayed correctly.
In other words, after clicking Home in the navigation bar, the list of posts is
not fully displayed, only the v-if part, and not the v-else part, and I have to
manually refresh the browser to update the sidebar correctly. to be given.

Please modify my code to reset and update the necessary data
when navigating to the home page or other page.