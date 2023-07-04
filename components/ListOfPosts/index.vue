<template>
  <div>

    <div v-for="post in posts " :key="post.id">
      <!-- show post.title if exists in concatenatedTitles else execute new logic -->
      <template v-if="concatenatedTitles.includes(post.title.rendered)">
        {{ post.title.rendered }}
      </template>
      <template v-else>
        <p>NOOOOT EEEEE</p>
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
  return posts.value.filter((post) => !post.categories.length);
});


// Initialize a variable to store concatenated titles
const concatenatedTitles = ref('');

// Concatenate post titles and store them in the 'concatenatedTitles' variable
nonCategorizedPosts.value.forEach((post) => {
  concatenatedTitles.value += post.title.rendered;
});

</script>