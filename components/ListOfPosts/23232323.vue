In the nuxt 3 program, using the following code, I have
shown the list of posts and categories in the sidebar:

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


// Initialize an array to store concatenated titles
const concatenatedTitles = ref([]);


// Add post titles into the 'concatenatedTitles' array
nonCategorizedPosts.value?.forEach((post) => {
  concatenatedTitles.value.push(post.title.rendered);
});


// Watch for changes to the post title
watch(
    () => posts.value,
    () => {
      // Update the concatenated titles array
      concatenatedTitles.value = [];
      nonCategorizedPosts.value?.forEach((post) => {
        concatenatedTitles.value.push(post.title.rendered);
      });
    }
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


But the problem is that when clicking on the home button, the list of posts
is not rendered correctly and I have to refresh the browser so that the sidebar
is displayed correctly.
In other words, after clicking Home in the navigation bar, the list of posts is
not fully displayed, only the v-if part, and not the v-else part, and I have to
refresh the browser with ctrl-f5 to update the sidebar correctly. to be given.

But the problem is that when clicking on the home button, the list of posts
is not rendered correctly and I have to refresh the browser so that the sidebar
is displayed correctly.
In other words, after clicking Home in the navigation bar, the list of posts is
not fully displayed, only the v-if part, and not the v-else part, and I have to
refresh the browser with ctrl-f5 to update the sidebar correctly. to be given.

To solve the problem, rewrite the code of the watch part so that in
addition to the posts.value, it also watches the value of the home or
other pages and updates the code.