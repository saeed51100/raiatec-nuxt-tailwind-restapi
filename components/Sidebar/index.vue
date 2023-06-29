<!-- Static sidebar for desktop -->
<template>
  <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex mt-16 lg:w-72 lg:flex-col-reverse">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4 pt-5">
      <ListOfPosts/>
    </div>
  </div>
</template>