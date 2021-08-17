<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit
                <span class="text-green-400 shadow">{{ state.name }}</span>
            </h2>
        </template>
        <div class="py-12">
            <div
                class="
                    flex
                    max-w-2xl
                    w-full
                    bg-white
                    shadow-md
                    rounded-lg
                    overflow-hidden
                    mx-auto
                "
            >
                <div class="w-2 bg-indigo-400"></div>

                <div class="flex items-center px-2 py-3">
                    <form
                        class="w-full max-w-lg"
                        method="POST"
                        @submit.prevent="update"
                    >
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="name"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="State Name"
                                />
                                <breeze-input
                                    id="name"
                                    class="
                                        appearance-none
                                        block
                                        w-full
                                        text-gray-700
                                        rounded
                                        py-3
                                        px-4
                                        mb-3
                                        leading-tight
                                        focus:outline-none focus:bg-white
                                    "
                                    type="text"
                                    name="name"
                                    v-model="currState.name"
                                    required
                                    autofocus
                                />
                                <div
                                    class="
                                        my-3
                                        bg-red-300
                                        text-red-800
                                        p-4
                                        rounded
                                        font-medium
                                    "
                                    v-if="errors.name"
                                >
                                    {{ errors.name }}
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="code"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="Country Code"
                                />
                                <select
                                    name="country_id"
                                    v-model="currState.country_id"
                                    class="
                                        appearance-none
                                        block
                                        w-full
                                        text-gray-700
                                        rounded
                                        py-3
                                        px-4
                                        mb-3
                                        leading-tight
                                        focus:outline-none focus:bg-white
                                    "
                                >
                                    <option disabled selected>
                                        Country Name
                                    </option>
                                    <option
                                        v-for="country in countries"
                                        :key="country.id"
                                        :value="country.id"
                                    >
                                        {{ country.name }}
                                    </option>
                                </select>
                                <div
                                    class="
                                        my-3
                                        bg-red-300
                                        text-red-800
                                        p-4
                                        rounded
                                        font-medium
                                    "
                                    v-if="errors.country_id"
                                >
                                    {{ errors.country_id }}
                                </div>
                            </div>
                        </div>

                        <breeze-button
                            class="
                                ml-4
                                bg-indigo-400
                                hover:bg-indigo-600
                                border-2
                                hover:border-blue-500
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-white"
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
                            &nbsp; Update
                        </breeze-button>
                    </form>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import BreezeButton from "@/Components/Button";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import { Inertia } from "@inertiajs/inertia";
export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
    },
    props: {
        state: {
            type: Object,
        },
        errors: {
            type: Object,
        },
        countries: {
            type: Array,
        },
    },
    data() {
        return {
            currState: this.state,
        };
    },
    methods: {
        update() {
            Inertia.patch(`/states/${this.currState.id}`, this.currState);
        },
    },
};
</script>
