
Sure, here is the Nuxt 3 code equivalent to the PHP WordPress code you provided:

HTML
<script setup lang="ts">
import { useState, useEffect } from 'vue'

const [rt_all, setRtAll] = useState([])
const [current_id, setCurrentId] = useState(null)

useEffect(() => {
  // Get all posts
  const query = {
    orderby: 'ID',
    order: 'ASC',
    posts_per_page: -1, //show all posts
  }
  const posts = await api.fetchPosts(query)

  // Get all categories for each post
  posts.forEach((post) => {
    const categories = await api.fetchCategories(post.id)
    post.categories = categories
  })

  // Set the current post ID
  setCurrentId(posts[0].id)

  // Get all categories
  const categories = await api.fetchCategories()
  setRtAll(categories)
}, [])

const renderCategories = (categories) => {
  return categories.map((category) => {
    const posts = category.posts.map((post) => {
      return (
          <li style="margin-top: 5px; list-style-type: none;">
          <a id="alltitle" href="/posts/[slug]" class="list-group">
          [title]
          </a>
          </li>
    )
    })

    return (
        <h5 class="cat-title bg-info">[name]</h5>
            <div class="cat-content">
        {posts}
        </div>
  )
  })
}

</script>

<template>
  <ul>
    {#each rt_all as category}
    {renderCategories(category)}
    {/each}
  </ul>
</template>
Use code with caution. Learn more
This code uses the useState and useEffect hooks to get all posts and categories, and then renders a list of categories and their posts. The renderCategories function takes a list of categories and returns a list of HTML elements for each category. The template section renders the list of categories and their posts.

To use this code, you will need to install the Nuxt 3 CLI and create a new Nuxt 3 project. Then, you can copy and paste the code above into your project. You will also need to add the following code to your nuxt.config.js file:

Code snippet
import api from './api'

export default {
api: {
url: 'http://localhost:3000',
},
}
Use code with caution. Learn more
This code tells Nuxt 3 to use the api module to fetch data from the server. Once you have done this, you can start your Nuxt 3 project and view the results in your browser.