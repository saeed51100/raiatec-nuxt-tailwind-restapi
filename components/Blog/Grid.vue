<script lang="ts" setup>
defineProps<{
  title: string;
  excerpt?: string;
  image?: string;
  slug?: string;
}>();
</script>

<template>
  <div class="max-w-lg mx-auto">
    <div class="bg-white shadow-md border border-gray-200 rounded-lg max-w-sm mb-5">

      <div v-if="image !== ' '">
        <img :src="image" :alt="title" class="rounded-t"/>
      </div>

      <div v-else>
        <img style="width: 100%;" src="~assets/svg/raiatecThumb.svg" :alt="title" class="rounded-t"/>
      </div>

      <div class="p-5">
        <h3 class="text-gray-900 font-bold text-2xl tracking-tight mb-2">

          <NuxtLink
              v-if="slug"
              :to="`/${slug}`"
          >{{ title }}

          </NuxtLink>


        </h3>
        <p
            v-if="excerpt"
            class="font-normal text-gray-700 mb-3 line-clamp-4 break-all"
        >
          {{ excerpt }}
        </p>
        <br>
        <br>
        <div class="relative">
          <NuxtLink
              v-if="slug"
              class="absolute bottom-0 left-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center"
              :to="`/${slug}`"
          >ادامه مطلب
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>
