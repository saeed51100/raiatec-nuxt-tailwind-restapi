The problem with your code is that the `concatenatedTitles` array is not being updated when you click on a post link. This is because the `concatenatedTitles` array is declared in the `setup` script, which is only executed once, when the component is first created. When you click on a post link, the `nonCategorizedPosts` array is updated, but the `concatenatedTitles` array is not. This is why the sidebar sometimes does not display correctly when you use the back button or the Home button in the navbar.

To fix this problem, you need to update the `concatenatedTitles` array in the `watch` script. The `watch` script is executed whenever the value of a variable changes, so this will ensure that the `concatenatedTitles` array is always up-to-date.

Here is the updated code:


<template>
  <div>

    <div v-for="post in posts " :key="post.id">
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

const nonCategorizedPosts = computed(() => {
  return posts.value?.filter(post => !post.categories.length);
});

categories.value.forEach(category => {
  category.posts = posts.value?.filter(post =>
      post.categories.includes(category.id)
  );
});


// Initialize an array to store concatenated titles
const concatenatedTitles = ref([]);


// Add post titles into the 'concatenatedTitles' array
nonCategorizedPosts.value?.forEach((post) => {
  concatenatedTitles.value.push(post.title.rendered);
});


// Watch for changes to the 'nonCategorizedPosts' array
watch(
    nonCategorizedPosts,
    () => {
      concatenatedTitles.value = [];
      nonCategorizedPosts.value?.forEach((post) => {
        concatenatedTitles.value.push(post.title.rendered);
      });
    },
    {
      deep: true,
    },
);


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


This code will now ensure that the `concatenatedTitles` array is always up-to-date, so the sidebar should always render correctly, even after you click on a post link