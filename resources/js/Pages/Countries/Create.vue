<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-indigo-500 leading-tight">
                Add Country
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
                        @submit.prevent="submit"
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
                                    value="Country Name"
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
                                    v-model="name"
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
                                <breeze-input
                                    id="code"
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
                                    name="code"
                                    v-model="country_code"
                                    required
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
                                    v-if="errors.country_code"
                                >
                                    {{ errors.country_code }}
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
                            create
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
import { reactive, toRefs } from "vue";
import { Inertia } from "@inertiajs/inertia";
export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
    },
    props: {
        errors: {
            type: Object,
        },
    },
    setup() {
        const form = reactive({
            name: "",
            country_code: "",
        });

        function submit() {
            Inertia.post("/countries", form);
        }

        // return
        return { ...toRefs(form), submit };
    },
};
</script>
