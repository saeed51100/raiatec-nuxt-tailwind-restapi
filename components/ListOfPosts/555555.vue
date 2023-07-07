The problem with your code is that the `concatenatedTitles` variable is not updated when you navigate to a different post. This is because the `concatenatedTitles` variable is declared in the `setup` script, which is only executed once, when the component is first created.

To fix this, you need to move the `concatenatedTitles` variable to the `watch` block of the component. The `watch` block will be executed whenever the value of one of the component's props or state variables changes. In this case, you can watch the `posts` prop and update the `concatenatedTitles` variable whenever the list of posts changes.

Here is the updated code:


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

// Watch the 'posts' prop and update the 'concatenatedTitles' variable whenever the list of posts changes
watch('posts', () => {
  concatenatedTitles.value = [];
  nonCategorizedPosts.value?.forEach((post) => {
    concatenatedTitles.value += post.title.rendered;
  });
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


This code will now update the `concatenatedTitles` variable whenever the list of posts changes. This will ensure that the `v-else` section of the sidebar is rendered correctly whenever you navigate to a different post.

You can test this by navigating to a different post and then using the back button or the Home link in the navbar. The sidebar should now be displayed correctly without having to refresh the browser.