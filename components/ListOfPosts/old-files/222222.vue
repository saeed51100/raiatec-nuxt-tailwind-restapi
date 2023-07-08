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