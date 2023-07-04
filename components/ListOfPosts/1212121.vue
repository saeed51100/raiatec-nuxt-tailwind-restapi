In the nuxt 3 code below, write the v-else code for me so that:
1- write the current post category and write all the blog posts related to that category below it.
2- Repeat this in the next loop if that category is not repeated.
<template>
  <div>

    <div v-for="post in posts " :key="post.id">
      <!-- show post.title if exists in concatenatedTitles else execute new logic -->
      <template v-if="concatenatedTitles.includes(post.title.rendered)">
        {{ post.title.rendered }}
      </template>
      <template v-else>
        <!-- categorized posts -->

      </template>
    </div>


  </div>
</template>

<script setup lang="ts">
import {ref, computed} from 'vue';
import useWpApi from '~/composables/useWpApi';

const {data: posts} = await useWpApi().getPosts();
const {data: categories} = await useWpApi().getCategories();

const currentId = ref(null); // Set the current ID
const isSingle = ref(false); // Set the single flag

const nonCategorizedPosts = computed(() => {
  return posts.value.filter((post) => !post.categories.length);
});


// Initialize a variable to store concatenated titles
const concatenatedTitles = ref('');

// Concatenate post titles and store them in the 'concatenatedTitles' variable
nonCategorizedPosts.value.forEach((post) => {
  concatenatedTitles.value += post.title.rendered;
});

</script>