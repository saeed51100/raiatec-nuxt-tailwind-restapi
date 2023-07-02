
Sure, here is the Nuxt 3 code that converts the PHP WordPress code you provided:

HTML
<script setup lang="ts">
import { useState } from 'vue'

const [rt_all, setRtAll] = useState([])
const [rt_new, setRtNew] = useState([])
const [current_id, setCurrentId] = useState(0)

const getCategories = async () => {
  const query = await fetch(`/wp-json/wp/v2/categories`)
  const categories = await query.json()

  for (const category of categories) {
    rt_all.push(category.name)
  }
}

const getPosts = async () => {
  const query = await fetch(`/wp-json/wp/v2/posts`)
  const posts = await query.json()

  for (const post of posts) {
    const categories = post.categories

    for (const category of categories) {
      if (!rt_new.includes(category.name)) {
        rt_new.push(category.name)
      }
    }
  }
}

const mounted = async () => {
  await getCategories()
  await getPosts()
  setCurrentId(document.querySelector('#current_id').value)
}
</script>

<template>
  <div>
    <ul>
      <li v-for="term in rt_new" :key="term">
        <h5 class="cat-title bg-info">{{ term }}</h5>
        <div class="cat-content">
          <ul>
            <li v-for="post in posts" :key="post.id">
              <a :href="post.link">{{ post.title }}</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</template>

<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

li {
  margin-bottom: 5px;
}

a {
  text-decoration: none;
}

.cat-title {
  background-color: #d9edf7;
  padding: 5px;
}

.cat-content {
  padding: 10px;
}
</style>
Use code with caution. Learn more
This code uses the useState hook to manage the state of the rt_all, rt_new, and current_id variables. The getCategories and getPosts functions fetch the categories and posts from WordPress, respectively. The mounted hook is called when the component is mounted, and it uses the getCategories and getPosts functions to fetch the data. The template and style sections define the HTML and CSS for the component.

To use this code, you would need to create a Nuxt 3 project and add the code to a .vue file. You would also need to configure the Nuxt 3 project to connect to WordPress. Once you have done that, you should be able to see the component in your browser.