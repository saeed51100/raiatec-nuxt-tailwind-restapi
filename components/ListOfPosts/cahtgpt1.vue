Here's the converted code using Nuxt.js 3 with the Composition API syntax:

html
Copy code
<template>
  <div>
    <ul>
      <li v-for="(post, index) in posts" :key="index" style="margin-top: 5px; list-style-type: none;">
        <a
            id="alltitle"
            :href="post.permalink"
            :class="{ 'list-group': isCurrentPost(post.ID) && isSinglePost }"
        >
          {{ post.title }}
        </a>
      </li>
    </ul>
    <template v-for="(term, index) in uniqueCategories" :key="index">
      <h5 class="cat-title bg-info">{{ term }}</h5>
      <div class="cat-content">
        <ul>
          <li v-for="(post, index) in getPostsByCategory(term)" :key="index" style="margin-top: 5px; list-style-type: none;">
            <a
                id="alltitle"
                :href="post.permalink"
                :class="{ 'list-group': isCurrentPost(post.ID) && isSinglePost }"
            >
              {{ post.title }}
            </a>
          </li>
        </ul>
      </div>
    </template>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';

const currentId = ref(<?php echo $current_id; ?>);
const posts = ref([]);
const categories = ref([]);

// Fetch posts using API or other methods
// Update `posts` and `categories` with the fetched data

function isCurrentPost(postId) {
  return postId === currentId.value;
}

function getPostsByCategory(category) {
  return posts.value.filter(post => post.categories.includes(category));
}

const uniqueCategories = computed(() => [...new Set(categories.value)]);

const isSinglePost = computed(() => {
  // Implement the logic to determine if it's a single post view
  // For example, you can check the route or other conditions
  return true;
});
</script>
Please note that you need to replace the placeholder logic for fetching posts and categories with your actual implementation. Also, make sure to define the necessary data structure to store the fetched posts and categories in the script setup part before the computed properties and methods are used.

The code assumes you have a posts array containing objects with properties like permalink, title, ID, and categories (an array of category names) that you can populate with the appropriate data.