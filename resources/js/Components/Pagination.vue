<script>
import { Link } from '@inertiajs/vue3'

export default {
  components: {
    Link,
  },
  props: {
    links: Object,
    registers: Object
  },
}
</script>
<template>
    <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
            <!-- <div class="flex items-center justify-between border-t dark:border-gray-500 dark:bg-gray-900 px-4 py-3 sm:px-6"> -->
                <div class="flex flex-1 justify-between sm:hidden">
                    <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                    <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                </div>
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-500  dark:text-gray-400">
                            Showing
                            <span class="font-medium"  v-html="registers.meta.from"></span>
                            to
                            <span class="font-medium" v-html="registers.meta.to"></span>
                            of
                            <span class="font-medium" v-html="registers.meta.total"></span>
                            results
                        </p>
                    </div>
                    <div v-if="registers.meta.links.length > 3">
                        <!-- <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                            <template v-for="(link, key) in registers.meta.links">
                                <div v-if="link.url === null" :key="key" class="mb-1 mr-1 px-4 py-3 text-gray-500  dark:text-gray-400 text-sm leading-4 border rounded" v-html="link.label" />
                                <Link v-else :key="`link-${key}`" class="relative inline-flex items-center border border-gray-300 dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-500  dark:text-gray-400 hover:bg-gray-50 focus:z-20" :class="{ 'z-10 bg--400 border-blue-800 text-blue-600': link.active }" :href="link.url" v-html="link.label" />
                            </template>
                        </nav> -->

                        <nav aria-label="Page navigation example">
                            <ul class="inline-flex -space-x-px" >
                                <template v-for="(link, key) in registers.meta.links">
                                    <div v-if="link.url === null" :key="key" class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" v-html="link.label" />
                                    <Link v-else :key="`link-${key}`" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" :class="{ 'text-blue-600 bg-blue-50  hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-700  dark:text-white': link.active }" :href="link.url" v-html="link.label" />
                                </template>
                                <!-- <li >
                                <a href="#" class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                                </li> -->
                                <!-- <li>
                                <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                                </li>
                                <li>
                                <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                                </li>
                                <li>
                                <a href="#" aria-current="page" class="px-3 py-2 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                                </li>
                                <li>
                                <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                                </li>
                                <li>
                                <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                                </li>
                                <li>
                                <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                                </li> -->
                            </ul>
                        </nav>
                    </div>
                </div>
            <!-- </div> -->
    </div>



</template>
