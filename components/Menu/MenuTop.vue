<!-- Navbar header -->
<template>
  <TransitionRoot as="template" :show="sidebarOpen">
    <Dialog as="div" class="relative z-50 lg:hidden" @close="sidebarOpen = false">
      <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0"
                       enter-to="opacity-100" leave="transition-opacity ease-linear duration-300"
                       leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-900/80"/>
      </TransitionChild>

      <div class="fixed inset-0 flex">
        <TransitionChild as="template"
                         enter="transition ease-in-out duration-300 transform"
                         enter-from="translate-x-full"
                         enter-to="translate-x-0"
                         leave="transition ease-in-out duration-300 transform"
                         leave-from="translate-x-0"
                         leave-to="translate-x-full"
        >
          <DialogPanel class="relative ml-0 flex w-full max-w-xs flex-1">
            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0"
                             enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100"
                             leave-to="opacity-0">
              <div class="absolute right-full top-0 flex w-16 justify-center pt-5">
                <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                  <span class="sr-only">Close sidebar</span>
                  <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true"/>
                </button>
              </div>
            </TransitionChild>
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4">
              <div class="flex h-16 shrink-0 items-center">
                <img class="h-8 w-auto" src="~assets/svg/raiatec.svg" alt="Raiatec Logo"/>
              </div>

              <ListOfPosts @close-modal="sidebarOpen = false"/>

            </div>
          </DialogPanel>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>


  <!--My navbar-->
  <div
      class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">

    <!-- Raiatec logo -->
    <NuxtLink to="/">
      <div class="flex h-16 shrink-0 items-center">
        <img class="h-8 w-auto" src="~assets/svg/raiatec.svg" alt="Raiatec Logo"/>
      </div>
    </NuxtLink>


    <!--Modal button-->
    <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
      <span class="sr-only">Open sidebar</span>
      <Bars3Icon class="h-6 w-6" aria-hidden="true"/>
    </button>

    <!--Search Form-->
    <div class="flex flex-1 items-center justify-center px-2 lg:ml-6">
      <div class="w-full max-w-lg lg:max-w-xs">
        <label for="search" class="sr-only">Search</label>
        <div class="relative">
          <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
          </div>
          <input id="search" name="search"
                 class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                 placeholder="Search" type="search"/>
        </div>
      </div>
    </div>

    <!--      Nav links-->
    <div class="<!--hidden--> lg:ml-6 lg:flex lg:space-x-8">
      <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
      <a href="/"
         class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">Home</a>
      <a href="/about"
         class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">About
        me</a>
    </div>

  </div>

</template>

<script setup lang="ts">
import {ref} from 'vue'
import {
  Dialog,
  DialogPanel,

  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
import {
  Bars3Icon,


  XMarkIcon,
} from '@heroicons/vue/24/outline'
import {ChevronDownIcon, MagnifyingGlassIcon} from '@heroicons/vue/20/solid'


const sidebarOpen = ref(false)
</script>
