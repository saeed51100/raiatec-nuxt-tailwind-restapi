<script lang="ts" setup>
defineProps<{
  title: string;
  slug?: string;
}>();
</script>

<template>
  <NuxtLink v-if="slug" :to="`/${slug}`">{{ title }}</NuxtLink>
</template>
