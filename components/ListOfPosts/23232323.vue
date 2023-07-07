In the nuxt 3 program, using the following code, I have
shown the list of posts and categories in the sidebar:

<!-- components/ListOfPosts/index.vue -->
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

<!-- composables/useWpApi.ts -->
/**
* WordPress Composables
* A collection of WordPress composable functions.
*/

import { Post } from "~~/types/post";

export default () => {
const config = useRuntimeConfig();
const WP_URL: string = config.public.wpUri;

const get = async <T>(endpoint: string) => {
return useFetch<T>(`${WP_URL}/wp-json/wp/v2/${endpoint}`);
  };

  const getPosts = async (
  category?: number,
  page: number = 1,
  perPgae: number = 20,
  fields: string = "author,id,excerpt,title,link,slug,date"
  ) => {
  let query: string = `posts?page=${page}&per_page=${perPgae}&_embed=1`;
  if (category) {
  query += `&categories=${category}`;
  }
  return get<Post[]>(query);
  };

  const getPost = async (slug: string) => {
  return get<Post[]>(`posts?slug=${slug}&_embed=1`);
  };

  const getCatgories = async (fields: string = "name,slug,count") => {
  return get<any>(`categories`);
    };

    const getCatgory = async (slug: string) => {
    return get<any>(`categories?slug=${slug}`);
      };

      return {
      get,
      getPosts,
      getPost,
      getCatgories,
      getCatgory,
      };
      };
      // composables/useWpApi.ts

But the problem is that sometimes the list of posts in the sidebar is not rendered correctly and I have to super refresh the browser so that the sidebar is displayed correctly.
In other words, sometimes after clicking on a post link and displaying the corresponding post, when I use the back button of the browser or when I use Home in the navbar, the sidebar is not displayed in full and only the v-if part , and not the v-else section, and I have to refresh the browser with ctrl-f5 to get the sidebar to display properly.
Where is the problem with my code?