Part code <!-- Store category.name to array -->
In the following code, modify it for me so that the value of category.name is added to the array in each loop
<template>
  <div>

    <div v-for="post in posts " :key="post.id">
      <!-- show post.title if exists in concatenatedTitles else execute new logic -->
      <template v-if="concatenatedTitles.includes(post.title.rendered)">
        {{ post.title.rendered }}
      </template>
      <template v-else>
        <!-- categorized posts -->
        <div v-for="category in categories" :key="category.id">
          <template v-if="post.categories.includes(category.id)">
            <h3 class="bg-red-200">{{ category.name }}</h3>
            <!-- Store category.name to array -->
            concatenatedCategory += category.name
            <ul><li>
              <li v-for="relatedPost in category.posts" :key="relatedPost.id">
                {{ relatedPost.title.rendered }}
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
  return posts.value.filter((post) => !post.categories.length);
});

categories.value.forEach((category) => {
  category.posts = posts.value.filter((post) =>
      post.categories.includes(category.id)
  );
});

// Initialize a variable to store concatenated titles
const concatenatedTitles = ref('');
const concatenatedCategory = ref('');

// Concatenate post titles and store them in the 'concatenatedTitles' variable
nonCategorizedPosts.value.forEach((post) => {
  concatenatedTitles.value += post.title.rendered;
});

</script>