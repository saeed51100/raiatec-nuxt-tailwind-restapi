The problem with your code is that you are using the `concatenatedTitles` variable in the `v-if` directive, but this variable is not updated when you click on a post link. This is because the `concatenatedTitles` variable is only updated when you fetch the list of posts from the WordPress API.

To fix this problem, you can use the `watch` directive to listen for changes to the `posts` variable and update the `concatenatedTitles` variable accordingly. Here is the updated code:


<template>
  <div>

    <div v-for="post in posts" :key="post.id">
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
import {ref, computed, watch} from 'vue';
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
const concatenatedTitles = ref([]);

// Concatenate post titles and store them in the 'concatenatedTitles' variable
nonCategorizedPosts.value?.forEach((post) => {
  concatenatedTitles.value += post.title.rendered;
});

// Watch the 'posts' variable and update the 'concatenatedTitles' variable accordingly
watch(
    () => posts.value,
    (newPosts) => {
      concatenatedTitles.value = [];
      newPosts?.forEach((post) => {
        concatenatedTitles.value += post.title.rendered;
      });
    }
);
</script>


This code will now update the `concatenatedTitles` variable whenever the `posts` variable changes. This will ensure that the `v-if` directive always renders the correct content.

To test this, you can click on a post link and then use the back button or the Home link in the navbar. The sidebar should now render correctly without having to refresh the browser.