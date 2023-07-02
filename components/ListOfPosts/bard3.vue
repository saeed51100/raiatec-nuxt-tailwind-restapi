
Sure, here is the Nuxt 3 code equivalent to the PHP WordPress code you provided:

Code snippet
<script setup lang="ts">
import { useState } from 'vue'

const [rt_all, setRtAll] = useState([])
const [rt_new, setRtNew] = useState([])
const [current_id, setCurrentId] = useState(0)

async function fetchData() {
  const response = await fetch('/wp-json/wp/v2/posts')
  const data = await response.json()

  for (const post of data) {
    const categories = post.categories
    const rt_post = []
    for (const category of categories) {
      rt_post.push(category.name)
    }
    const rt_new = array_diff(rt_post, rt_all)
    setRtAll(array_merge(rt_all, rt_new))

    if (empty(rt_post)) {
      const a = document.createElement('a')
      a.href = post.link
      a.textContent = post.title
      a.classList.add('list-group')
      document.querySelector('#alltitle').appendChild(a)
    }

    for (const term of rt_new) {
      const args1 = {
        orderby: 'ID',
        order: 'ASC',
        posts_per_page: -1, //show all posts
        tax_query: [
          {
            taxonomy: 'category',
            field: 'slug',
            terms: term,
          }
        ]
      }

      const posts1 = await fetch(`/wp-json/wp/v2/posts?${new URLSearchParams(args1)}`)
      const data1 = await posts1.json()

      if (posts1.status === 200) {
        const h5 = document.createElement('h5')
        h5.classList.add('cat-title')
        h5.textContent = term
        document.querySelector('#alltitle').appendChild(h5)

        const div = document.createElement('div')
        div.classList.add('cat-content')
        for (const post of data1) {
          const a = document.createElement('a')
          a.href = post.link
          a.textContent = post.title
          a.classList.add('list-group')
          div.appendChild(a)
        }
        document.querySelector('#alltitle').appendChild(div)
      }
    }
  }
}

fetchData()
</script>
Use code with caution. Learn more
This code uses the useState hook to store the current list of posts, the new list of posts, and the current post ID. It also uses the fetch API to fetch the list of posts from the WordPress REST API. The fetchData function is called once when the page loads, and it updates the state variables with the new list of posts. The render function then uses the state variables to render the list of posts.

To use this code, you will need to create a Nuxt 3 project and install the @nuxtjs/axios and @nuxtjs/wordpress modules. You can then copy and paste the code above into your pages/index.vue file.