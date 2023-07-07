The problem with your code is that you are using the `concatenatedTitles` variable in the `v-if` directive, but this variable is not yet initialized when the first render happens. This is because the `nonCategorizedPosts` variable is also not initialized yet, since it depends on the `posts` variable, which is also fetched asynchronously.

To fix this, you can move the `concatenatedTitles` variable declaration outside of the `computed` block. This will ensure that the variable is initialized before the first render happens.

Here is the updated code:


<template>
  <div>

    <div v-for="post in posts " :key="post.id">
      <!-- show post.title if exists in concatenatedTitles else execute new logic -->
      <template v-if="concatenatedTitles.includes(post.title.rendered)">
        <nuxt-link :to="`/${post.slug}`" @click="$emit('close-modal')">
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
                <nuxt-link :to="`/${relatedPost.slug}`" @click="$emit('close-modal')">
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

const nonCategorizedPosts = computed(() => {
  return posts.value?.filter(post => !post.categories.length);
});

categories.value.forEach(category => {
  category.posts = posts.value?.filter(post =>
      post.categories.includes(category.id)
  );
});

// Initialize a variable to store concatenated titles
const concatenatedTitles = [];

// Concatenate post titles and store them in the 'concatenatedTitles' variable
nonCategorizedPosts.value?.forEach((post) => {
  concatenatedTitles.push(post.title.rendered);
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


This should fix the problem with the sidebar not being rendered correctly.