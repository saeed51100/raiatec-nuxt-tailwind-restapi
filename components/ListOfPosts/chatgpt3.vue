To convert the given PHP WordPress code to Nuxt 3 code using the Composition API and <script setup lang="ts"> syntax, you can follow the example below:

    html
Copy code
<template>
<div>
    <!-- Your HTML/Template Code Goes Here -->
    <ul v-if="posts.length">
    <li
        v-for="(post, index) in posts"
  :key="index"
style="margin-top: 5px; list-style-type: none;"
    >
    <a
:id="`alltitle-${index}`"
:href="post.link"
:class="{ 'list-group': isCurrentPost(post) }"
    >
    {{ post.title }}
</a>
</li>
</ul>
<div v-else>
<!-- Handle no posts case -->
</div>
</div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const posts = ref([]);
const currentId = ref('');

const isCurrentPost = (post) => {
  return post.id === currentId.value && isSinglePost();
};

const isSinglePost = () => {
  // Define your condition here to determine if it's a single post
  // You may use the `useRoute` function from Vue Router to get the current route
  // Example: return useRoute().name === 'single-post';
  return false;
};

const fetchData = async () => {
  try {
    const response = await fetch('/wp-json/wp/v2/posts'); // Adjust the endpoint URL based on your WordPress setup
    if (!response.ok) {
      throw new Error('Unable to fetch posts');
    }
    const data = await response.json();
    posts.value = data.map((post) => ({
      id: post.id,
      title: post.title.rendered,
      link: post.link,
    }));
  } catch (error) {
    console.error(error);
    // Handle the error case
  }
};

onMounted(() => {
  fetchData();
  currentId.value = '123'; // Replace '123' with your current post ID
});
</script>
Please note that this example assumes you have a REST API endpoint set up in your WordPress installation that provides the necessary post data. Adjust the endpoint URL in the fetch function according to your WordPress setup.

Also, the code above assumes you are using Vue Router to handle routing in your Nuxt application. If you are not using Vue Router, you can adjust the isSinglePost function according to your routing implementation.

Make sure to replace the currentId.value = '123'; line with the actual current post ID you want to highlight.

The example code provided focuses on fetching and rendering the posts' titles and links based on the given PHP code. Adjustments may be needed depending on your specific requirements and the structure of your Nuxt 3 project.