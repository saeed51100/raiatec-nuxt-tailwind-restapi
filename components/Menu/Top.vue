<script lang="ts" setup></script>
<template>
  <nav class="bg-gray-900 text-white py-5 border-b border-gray-700">
    <div
      class="container flex flex-col sm:flex-row justify-center gap-3 sm:gap-0 sm:justify-between items-center"
    >
      <NuxtLink to="/" class="text-2xl font-medium">Elon's Blog</NuxtLink>
      <ul class="nav">
        <li>
          <NuxtLink to="/">Home</NuxtLink>
        </li>
        <li>
          <NuxtLink to="/categories">Categories</NuxtLink>
        </li>
      </ul>
    </div>
  </nav>




  <header class="p-1 bg-light sticky-top shadow">

    <div class="d-flex flex-wrap align-items-center justify-content-around">

      <ul class="nav justify-content-center">


        <li :class="{'list-groop': $route.path === '/'}">
          <NuxtLink to="/">Home</NuxtLink>
        </li>
        <li :class="{'list-groop': $route.path === '/categories'}">
          <NuxtLink to="/categories">Categories</NuxtLink>
        </li>
        <li :class="{'list-groop': $route.path === '/about'}">
          <NuxtLink to="/about">About Me</NuxtLink>
        </li>


        <!--                <li><a href="http://localhost/test.raiatec.com/about-us/" class="nav-link px-2 text-white">About Me</a></li>-->
      </ul>

      <!-- Button trigger modal -->
      <button class="navbar navbar-toggler d-md-none collapsed"
              type="button"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
              aria-controls="sidebarMenu"
              aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <form class="d-none d-md-block" role="search">
        <input type="search" class="form-control bg-light" placeholder="Search..."
               aria-label="Search">
      </form>
      <img src="~assets/svg/raiatec.svg" alt="Raiatec Logo"/>

    </div>

  </header>






</template>

<style>
ul.nav {
  @apply flex gap-5 items-center justify-end;
}
ul.nav > li > a {
  @apply text-gray-300 hover:text-gray-50;
}
ul.nav > li > a.router-link-active {
  @apply text-primary-400;
}
</style>
