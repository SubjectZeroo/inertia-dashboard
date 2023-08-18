<script setup>
import { reactive, computed, ref, watch } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { usePermission } from "@/Composables/Permissions.js";
import { useDark, useToggle, onClickOutside } from "@vueuse/core";
import useEventsBus from '@/Composables/eventBus.js';

const { hasRoles } = usePermission();
const {emit}=useEventsBus()
const { bus } = useEventsBus();
const isDark = useDark();
const toggleDark = useToggle(isDark);

const isHamburgerMenuOpen = ref(false);
// function toggleHamburgerMenu() {

//         isHamburgerMenuOpen.value = !isHamburgerMenuOpen.value;

//     emit('sidebarCollapsed', isHamburgerMenuOpen.value)
// }

const onToggleClick = () => {
    //   unsetMobileItem()
    //   updateIsCollapsed(!isCollapsed.value)
    //   context.emit('update:collapsed', isCollapsed.value)
    isHamburgerMenuOpen.value = !isHamburgerMenuOpen.value;
    emit('sidebarCollapsed', isHamburgerMenuOpen.value)
    }

watch(()=> bus.value.get('close'), (val) => {
    const [sidebarCollapsedBus] = val ?? []
    isHamburgerMenuOpen.value = sidebarCollapsedBus
});


const switchToTeam = (team) => {
  router.put(
    route("current-team.update"),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    }
  );
};

const logout = () => {
  router.post(route("logout"));
};


// const target = ref(null);
// const targetNav = ref(null);
// onClickOutside(targetNav, (event) =>  {
//     console.log(event)
//     // isHamburgerMenuOpen.value = event.isTrusted;
//     // { ignore: [targetNav] }

//     // emit('close', isHamburgerMenuOpen.value);
// });
</script>
<template>
  <nav
  ref="targetNav"
    class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start">
          <button
            id="toggleSidebarMobile"
            aria-expanded="true"
            aria-controls="sidebar"
            @click="onToggleClick()"
            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <svg

             v-if="isHamburgerMenuOpen"
              id="toggleSidebarMobileHamburger"
              class="w-6 h-6"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"
              ></path>
            </svg>
            <svg

                v-else
              id="toggleSidebarMobileClose"
              class=" w-6 h-6"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </button>
          <!-- <a href="https://flowbite-admin-dashboard.vercel.app/" class="flex ml-2 md:mr-24">
                        <img src="https://flowbite-admin-dashboard.vercel.app/images/logo.svg" class="h-8 mr-3"
                            alt="FlowBite Logo">
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Flowbite</span>
                    </a> -->
          <Link :href="route('dashboard')" class="flex ml-2 md:mr-24">
            <ApplicationMark class="block h-9 w-auto mr-3" />
            <span
              class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"
              >Maquinarium</span
            >
          </Link>
        </div>
        <div class="flex items-center">
          <div class="hidden mr-3 -mb-1 sm:block">
            <span></span>
          </div>

          <button
            @click="toggleDark()"
            id="theme-toggle"
            data-tooltip-target="tooltip-toggle"
            type="button"
            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
          >
            <svg
              v-if="isDark"
              class="w-5 h-5"
              id="theme-toggle-dark-icon"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z"
                clip-rule="evenodd"
              />
            </svg>
            <svg
              v-else
              id="theme-toggle-light-icon"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              class="w-6 h-6"
            >
              <path
                d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"
              />
            </svg>
          </button>
          <div
            id="tooltip-toggle"
            role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip"
            style="
              position: absolute;
              inset: 0px auto auto 0px;
              margin: 0px;
              transform: translate(1195px, 63px);
            "
            data-popper-placement="bottom"
          >
            Toggle dark mode
            <div
              class="tooltip-arrow"
              data-popper-arrow=""
              style="position: absolute; left: 0px; transform: translate(69px, 0px)"
            ></div>
          </div>

          <!-- <div class="ml-3 relative"> -->
          <!-- Teams Dropdown -->
          <!-- <Dropdown
              v-if="$page.props.jetstream.hasTeamFeatures"
              align="right"
              width="60"
            >
              <template #trigger>
                <span class="inline-flex rounded-md">
                  <button
                    type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                  >
                    {{ $page.props.auth.user.current_team.name }}

                    <svg
                      class="ml-2 -mr-0.5 h-4 w-4"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                      />
                    </svg>
                  </button>
                </span>
              </template> -->

          <!-- <template #content>
                <div class="w-60"> -->
          <!-- Team Management -->
          <!-- <template v-if="$page.props.jetstream.hasTeamFeatures">
                    <div class="block px-4 py-2 text-xs text-gray-400">Manage Team</div> -->

          <!-- Team Settings -->
          <!-- <DropdownLink
                      :href="route('teams.show', $page.props.auth.user.current_team)"
                    >
                      Team Settings
                    </DropdownLink>

                    <DropdownLink
                      v-if="$page.props.jetstream.canCreateTeams"
                      :href="route('teams.create')"
                    >
                      Create New Team
                    </DropdownLink>

                    <div class="border-t border-gray-200" /> -->

          <!-- Team Switcher -->
          <!-- <div class="block px-4 py-2 text-xs text-gray-400">Switch Teams</div>

                    <template
                      v-for="team in $page.props.auth.user.all_teams"
                      :key="team.id"
                    >
                      <form @submit.prevent="switchToTeam(team)">
                        <DropdownLink as="button">
                          <div class="flex items-center">
                            <svg
                              v-if="team.id == $page.props.auth.user.current_team_id"
                              class="mr-2 h-5 w-5 text-green-400"
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke-width="1.5"
                              stroke="currentColor"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                              />
                            </svg>

                            <div>{{ team.name }}</div>
                          </div>
                        </DropdownLink>
                      </form>
                    </template>
                  </template>
                </div>
              </template>
            </Dropdown>
          </div> -->
          <!-- Settings Dropdown -->
          <div class="ml-3 relative">
            <Dropdown align="right" width="48">
              <template #trigger>
                <button
                  v-if="$page.props.jetstream.managesProfilePhotos"
                  class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                >
                  <img
                    class="h-8 w-8 rounded-full object-cover"
                    :src="$page.props.auth.user.data.profile_photo_url"
                    :alt="$page.props.auth.user.data.name"
                  />
                </button>

                <span v-else class="inline-flex rounded-md">
                  <button
                    type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                  >
                    {{ $page.props.auth.user.data.name }}

                    <svg
                      class="ml-2 -mr-0.5 h-4 w-4"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                      />
                    </svg>
                  </button>
                </span>
              </template>

              <template #content>
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">Manage Account</div>

                <DropdownLink :href="route('profile.show')"> Profile </DropdownLink>

                <DropdownLink
                  v-if="$page.props.jetstream.hasApiFeatures"
                  :href="route('api-tokens.index')"
                >
                  API Tokens
                </DropdownLink>

                <div class="border-t border-gray-200" />

                <!-- Authentication -->
                <form @submit.prevent="logout">
                  <DropdownLink as="button"> Log Out </DropdownLink>
                </form>
              </template>
            </Dropdown>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>
