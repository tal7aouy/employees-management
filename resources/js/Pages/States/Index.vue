<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-indigo-500 leading-tight">
                states
            </h2>
        </template>
        <Toast v-if="$page.props.toast" :toast="$page.props.toast" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div
                            class="
                                flex flex-wrap
                                justify-between
                                items-center
                                my-4
                                mx-auto
                                w-3/4
                            "
                        >
                            <div class="pt-2 relative text-gray-600">
                                <!-- search -->
                                <input
                                    class="
                                        border-none
                                        bg-white
                                        h-10
                                        px-5
                                        pr-16
                                        rounded-lg
                                        text-sm
                                        focus:outline-none
                                    "
                                    type="search"
                                    name="search"
                                    placeholder="Search"
                                    v-model="searchInput.search"
                                    @keyup.enter="search"
                                />
                            </div>
                            <inertia-link
                                :href="route('states.create')"
                                class="
                                    inline-flex
                                    items-center
                                    px-4
                                    py-2
                                    bg-indigo-800
                                    border border-transparent
                                    rounded-md
                                    font-semibold
                                    text-xs text-white
                                    uppercase
                                    tracking-widest
                                    hover:bg-indigo-700
                                    active:bg-indigo-900
                                    focus:outline-none
                                    focus:border-indigo-900
                                    focus:ring
                                    ring-indigo-300
                                    disabled:opacity-25
                                    transition
                                    ease-in-out
                                    duration-150
                                "
                                >create New</inertia-link
                            >
                        </div>
                        <table
                            class="
                                rounded-t-lg
                                m-5
                                w-5/6
                                mx-auto
                                text-gray-100
                                bg-gray-600
                            "
                        >
                            <tr class="text-left border-b-2 border-indigo-300">
                                <th class="px-4 py-3">State Name</th>
                                <th class="px-4 py-3">Country</th>
                                <th class="px-4 py-3 text-center">Settings</th>
                            </tr>

                            <tr
                                v-for="state in states"
                                :key="state.id"
                                class="border-b border-indigo-400"
                            >
                                <td class="px-4 py-3">
                                    {{ state.name }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ state.country.name }}
                                </td>
                                <td
                                    class="
                                        px-4
                                        py-3
                                        flex flex-wrap
                                        justify-center
                                        items-center
                                    "
                                >
                                    <inertia-link
                                        class="mx-2 px-2 rounded-md"
                                        :href="route('states.edit', [state.id])"
                                        ><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-green-700"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </inertia-link>
                                    <form
                                        @submit.prevent="remove(state.id)"
                                        method="POST"
                                    >
                                        <button
                                            class="mx-2 px-2 mt-2 rounded-md"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 text-red-700"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import BreezeNavLink from "@/Components/NavLink";
import Toast from "@/Components/Toast";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";
export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeNavLink,
        Toast,
    },
    props: {
        states: {
            type: Array,
            required: true,
        },
    },
    setup() {
        const searchInput = reactive({
            search: "",
        });
        function remove(id) {
            Inertia.delete(`/states/${id}`);
        }

        function search() {
            Inertia.get(`/states`, searchInput);
        }

        return {
            remove,
            searchInput,
            search,
        };
    },
};
</script>
