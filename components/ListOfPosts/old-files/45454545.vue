I have a nuxt 3 app that shows a list of posts and categories in the sidebar.
 But the problem is that when I click the home button, the list of posts is not
  updated properly and I have to manually refresh the browser to update the sidebar.
   I tried onBeforeRouteUpdate to solve the problem, but this is related to vue 3 and
    unfortunately it didn't work with nuxt 3 and <script setup> syntax.
     Now my question is, am I limited in using vue 3 methods in nuxt? And for example, in
      the example above, what should I do to use onBeforeRouteUpdate in nuxt 3?