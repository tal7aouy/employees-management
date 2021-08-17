<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <inertia-link :href="route('dashboard')">
                                    <breeze-application-logo
                                        class="block h-9 w-auto"
                                    />
                                </inertia-link>
                            </div>

                            <!-- Navigation Links -->
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <breeze-dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="
                                                    inline-flex
                                                    items-center
                                                    px-3
                                                    py-2
                                                    border border-transparent
                                                    text-sm
                                                    leading-4
                                                    font-medium
                                                    rounded-md
                                                    text-gray-500
                                                    bg-white
                                                    hover:text-gray-700
                                                    focus:outline-none
                                                    transition
                                                    ease-in-out
                                                    duration-150
                                                "
                                            >
                                                {{
                                                    $page.props.auth.user
                                                        .username
                                                }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <breeze-dropdown-link
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </breeze-dropdown-link>
                                    </template>
                                </breeze-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="
                                    inline-flex
                                    items-center
                                    justify-center
                                    p-2
                                    rounded-md
                                    text-gray-400
                                    hover:text-gray-500 hover:bg-gray-100
                                    focus:outline-none
                                    focus:bg-gray-100
                                    focus:text-gray-500
                                    transition
                                    duration-150
                                    ease-in-out
                                "
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <breeze-responsive-nav-link
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </breeze-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <breeze-responsive-nav-link
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </breeze-responsive-nav-link>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->

            <!-- Page Content -->
            <main class="flex flex-wrap md:flex-nowrap">
                <div class="bg-white w-full md:w-64 h-screen">
                    <div class="overflow-y-auto overflow-x-hidden flex-grow">
                        <ul class="flex flex-col py-4 space-y-1">
                            <li>
                                <breeze-nav-link
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                    class="
                                        relative
                                        flex flex-row
                                        items-center
                                        h-11
                                        focus:outline-none
                                        text-gray-600
                                        pr-6
                                    "
                                >
                                    <span
                                        class="
                                            inline-flex
                                            justify-center
                                            items-center
                                            ml-4
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="
                                            ml-2
                                            text-sm
                                            tracking-wide
                                            truncate
                                        "
                                        >Dashboard
                                    </span>
                                </breeze-nav-link>
                            </li>
                            <li>
                                <breeze-nav-link
                                    :href="route('users.index')"
                                    :active="route().current('users.index')"
                                    class="
                                        relative
                                        flex flex-row
                                        items-center
                                        h-11
                                        focus:outline-none
                                        text-gray-600
                                        pr-6
                                    "
                                >
                                    <span
                                        class="
                                            inline-flex
                                            justify-center
                                            items-center
                                            ml-4
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="
                                            ml-2
                                            text-sm
                                            tracking-wide
                                            truncate
                                        "
                                        >Users</span
                                    >
                                </breeze-nav-link>
                            </li>
                            <li>
                                <breeze-nav-link
                                    :href="route('countries.index')"
                                    :active="route().current('countries.index')"
                                    class="
                                        relative
                                        flex flex-row
                                        items-center
                                        h-11
                                        focus:outline-none
                                        text-gray-600
                                        pr-6
                                    "
                                >
                                    <span
                                        class="
                                            inline-flex
                                            justify-center
                                            items-center
                                            ml-4
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="
                                            ml-2
                                            text-sm
                                            tracking-wide
                                            truncate
                                        "
                                        >Countries</span
                                    >
                                </breeze-nav-link>
                            </li>
                            <li>
                                <breeze-nav-link
                                    :href="route('states.index')"
                                    :active="route().current('states.index')"
                                    class="
                                        relative
                                        flex flex-row
                                        items-center
                                        h-11
                                        focus:outline-none
                                        text-gray-600
                                        pr-6
                                    "
                                >
                                    <span
                                        class="
                                            inline-flex
                                            justify-center
                                            items-center
                                            ml-4
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="
                                            ml-2
                                            text-sm
                                            tracking-wide
                                            truncate
                                        "
                                        >States</span
                                    >
                                </breeze-nav-link>
                            </li>
                            <li>
                                <breeze-nav-link
                                    :href="route('cities.index')"
                                    :active="route().current('cities.index')"
                                    class="
                                        relative
                                        flex flex-row
                                        items-center
                                        h-11
                                        focus:outline-none
                                        text-gray-600
                                        pr-6
                                    "
                                >
                                    <span
                                        class="
                                            inline-flex
                                            justify-center
                                            items-center
                                            ml-4
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="
                                            ml-2
                                            text-sm
                                            tracking-wide
                                            truncate
                                        "
                                        >Cities</span
                                    >
                                </breeze-nav-link>
                            </li>
                            <li>
                                <breeze-nav-link
                                    :href="route('departments.index')"
                                    :active="
                                        route().current('departments.index')
                                    "
                                    class="
                                        relative
                                        flex flex-row
                                        items-center
                                        h-11
                                        focus:outline-none
                                        text-gray-600
                                        pr-6
                                    "
                                >
                                    <span
                                        class="
                                            inline-flex
                                            justify-center
                                            items-center
                                            ml-4
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="
                                            ml-2
                                            text-sm
                                            tracking-wide
                                            truncate
                                        "
                                        >Departments</span
                                    >
                                </breeze-nav-link>
                            </li>
                            <li>
                                <breeze-nav-link
                                    :href="route('employees.index')"
                                    :active="route().current('employees.index')"
                                    class="
                                        relative
                                        flex flex-row
                                        items-center
                                        h-11
                                        focus:outline-none
                                        text-gray-600
                                        pr-6
                                    "
                                >
                                    <span
                                        class="
                                            inline-flex
                                            justify-center
                                            items-center
                                            ml-4
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="
                                            ml-2
                                            text-sm
                                            tracking-wide
                                            truncate
                                        "
                                        >Employees</span
                                    >
                                </breeze-nav-link>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="
                                        relative
                                        flex flex-row
                                        items-center
                                        h-11
                                        focus:outline-none
                                        hover:bg-gray-50
                                        text-gray-600
                                        hover:text-gray-800
                                        border-l-4 border-transparent
                                        hover:border-indigo-500
                                        pr-6
                                    "
                                >
                                    <span
                                        class="
                                            inline-flex
                                            justify-center
                                            items-center
                                            ml-4
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="
                                            ml-2
                                            text-sm
                                            tracking-wide
                                            truncate
                                        "
                                        >Profile</span
                                    >
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="
                                        relative
                                        flex flex-row
                                        items-center
                                        h-11
                                        focus:outline-none
                                        hover:bg-gray-50
                                        text-gray-600
                                        hover:text-gray-800
                                        border-l-4 border-transparent
                                        hover:border-indigo-500
                                        pr-6
                                    "
                                >
                                    <span
                                        class="
                                            inline-flex
                                            justify-center
                                            items-center
                                            ml-4
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                            ></path>
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="
                                            ml-2
                                            text-sm
                                            tracking-wide
                                            truncate
                                        "
                                        >Settings</span
                                    >
                                </a>
                            </li>
                            <li>
                                <breeze-nav-link
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    class="
                                        relative
                                        flex flex-row
                                        items-center
                                        h-11
                                        focus:outline-none
                                        hover:bg-gray-50
                                        text-gray-600
                                        hover:text-gray-800
                                        border-l-4 border-transparent
                                        hover:border-indigo-500
                                        pr-6
                                    "
                                >
                                    <span
                                        class="
                                            inline-flex
                                            justify-center
                                            items-center
                                            ml-4
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="
                                            ml-2
                                            text-sm
                                            tracking-wide
                                            truncate
                                        "
                                        >Logout</span
                                    >
                                </breeze-nav-link>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="w-full px-4 md:px-0">
                    <header
                        class="bg-white shadow hidden md:block"
                        v-if="$slots.header"
                    >
                        <div
                            class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"
                        >
                            <slot name="header" />
                        </div>
                    </header>
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo";
import BreezeDropdown from "@/Components/Dropdown";
import BreezeDropdownLink from "@/Components/DropdownLink";
import BreezeNavLink from "@/Components/NavLink";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink";

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
};
</script>
