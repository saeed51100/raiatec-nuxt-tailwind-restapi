<template>
  <div>
    <div class="side-widget m-3">
      <h3>Post title</h3>
      <hr style="height: 3px" />
    </div>

    <ul>
      <li v-for="post in posts" :key="post.id">
        <a
            :href="post.link"
            :class="{ 'list-group': post.id === currentId && isSingle }"
        >
          {{ post.title.rendered }}
        </a>
      </li>
    </ul>

    <div v-for="category in categories" :key="category.term_id">
      <h5 class="cat-title bg-info">{{ category.name }}</h5>
      <div class="cat-content">
        <ul>
          <li v-for="post in category.posts" :key="post.id">
            <a
                :href="post.link"
                :class="{ 'list-group': post.id === currentId && isSingle }"
            >
              {{ post.title.rendered }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentId: null,
      isSingle: false,
      posts: [],
      categories: [],
    };
  },
  async fetch() {
    const response = await this.$axios.get('https://your-wordpress-api-url/wp-json/wp/v2/posts?_embed');
    this.posts = response.data;

    // Extract unique categories from the posts
    const uniqueCategories = [...new Set(this.posts.flatMap(post => post.categories))];
    for (const categoryId of uniqueCategories) {
      const categoryResponse = await this.$axios.get(
          `https://your-wordpress-api-url/wp-json/wp/v2/categories/${categoryId}?_embed&per_page=100`
      );
      const category = categoryResponse.data;

      const postsResponse = await this.$axios.get(
          `https://your-wordpress-api-url/wp-json/wp/v2/posts?_embed&categories=${categoryId}`
      );
      const posts = postsResponse.data;

      this.categories.push({
        term_id: category.term_id,
        name: category.name,
        posts,
      });
    }
  },
};
</script>