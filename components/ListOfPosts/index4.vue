<!-- components/PostsSidebar.vue -->
<template>
  <div class="side-widget m-3">
    <h3>Post title</h3>
    <hr style="height: 3px">
  </div>
  <div v-if="loading">Loading...</div>
  <div v-else>
    <div v-for="category in categories" :key="category.id">
      <h5 class="cat-title bg-info">{{ category.name }}</h5>
      <div class="cat-content">
        <ul>
          <li
              v-for="post in postsByCategory(category.id)"
              :key="post.id"
              style="margin-top: 5px; list-style-type: none;"
          >
            <a
                id="alltitle"
                :href="post.link"
                :class="{ 'list-group': currentId === post.id && isSingle }"
            >
              {{ post.title.rendered }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import {ref, computed} from 'vue'
import {useFetch} from '@nuxtjs/composition-api'

const loading = ref(false)

// Fetch categories
const {data: categories, error: categoriesError} = useFetch(async () => {
  loading.value = true
  const res = await fetch('/wp-json/wp/v2/categories')
  const data = await res.json()
  loading.value = false
  return data
})

// Fetch posts
const {data: posts, error: postsError} = useFetch(async () => {
  loading.value = true
  const res = await fetch('/wp-json/wp/v2/posts?_embed&order=desc&orderby=id')
  const data = await res.json()
  loading.value = false
  return data
})

// Get current post ID and check if it's a single post
const currentId = 0 // Replace this with the actual current post ID
const isSingle = true // Replace this with the actual condition

const postsByCategory = (categoryId) => {
  if (!posts.value) return []
  return posts.value.filter((post) => post.categories.includes(categoryId))
}

if (categoriesError.value || postsError.value) {
  console.error('Error fetching data:', categoriesError.value, postsError.value)
}
</script>

<!--
This code fetches the categories and posts from the WordPress REST API, and
  then displays them similarly to your PHP code. Make sure to replace the currentId
    and isSingle values with the actual values in your application. You might need
      to adjust some parts of the code to fit your app's requirements, but this
        should give you a good starting point.
-->