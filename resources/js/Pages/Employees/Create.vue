<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add User
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
                                    for="firstname"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="First Name"
                                />
                                <breeze-input
                                    id="firstname"
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
                                    name="first_name"
                                    v-model="first_name"
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
                                    v-if="errors.first_name"
                                >
                                    {{ errors.first_name }}
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="last_name"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="Last Name"
                                />
                                <breeze-input
                                    id="last_name"
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
                                    name="last_name"
                                    v-model="last_name"
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
                                    v-if="errors.last_name"
                                >
                                    {{ errors.last_name }}
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="middle_name"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="Middle Name"
                                />
                                <breeze-input
                                    id="middle_name"
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
                                    name="middle_name"
                                    v-model="middle_name"
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
                                    v-if="errors.middle_name"
                                >
                                    {{ errors.middle_name }}
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="address"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="Address"
                                />
                                <breeze-input
                                    id="address"
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
                                    name="address"
                                    v-model="address"
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
                                    v-if="errors.address"
                                >
                                    {{ errors.address }}
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="department_id"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="Department"
                                />
                                <select
                                    id="department_id"
                                    name="department_id"
                                    v-model="department_id"
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
                                    <option selected disabled>
                                        Department Name
                                    </option>

                                    <option
                                        v-for="department in departments"
                                        :key="department.id"
                                        :value="department.id"
                                    >
                                        {{ department.name }}
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
                                    v-if="errors.department_id"
                                >
                                    {{ errors.department_id }}
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="city_id"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="City"
                                />
                                <select
                                    id="city_id"
                                    name="city_id"
                                    v-model="city_id"
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
                                    <option selected disabled>City Name</option>
                                    <option
                                        v-for="city in cities"
                                        :key="city.id"
                                        :value="city.id"
                                    >
                                        {{ city.name }}
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
                                    v-if="errors.city"
                                >
                                    {{ errors.city }}
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="state_id"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="State"
                                />
                                <select
                                    id="state_id"
                                    name="state_id"
                                    v-model="state_id"
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
                                    <option selected disabled>
                                        State Name
                                    </option>

                                    <option
                                        v-for="state in states"
                                        :key="state.id"
                                        :value="state.id"
                                    >
                                        {{ state.name }}
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
                                    v-if="errors.state_id"
                                >
                                    {{ errors.state_id }}
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="country_id"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="Country"
                                />
                                <select
                                    id="city_id"
                                    name="country_id"
                                    v-model="country_id"
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
                                    <option selected disabled>
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
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="zip_code"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="Zip Code"
                                />
                                <breeze-input
                                    id="zip_code"
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
                                    name="zip_code"
                                    v-model="zip_code"
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
                                    v-if="errors.zip_code"
                                >
                                    {{ errors.zip_code }}
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="birthdate"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="Birth Date"
                                />
                                <breeze-input
                                    id="birthdate"
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
                                    type="date"
                                    name="birthdate"
                                    v-model="birthdate"
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
                                    v-if="errors.birthdate"
                                >
                                    {{ errors.birthdate }}
                                </div>
                            </div>
                        </div>
                        <div class="-mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <breeze-label
                                    for="date_hired"
                                    class="
                                        block
                                        uppercase
                                        tracking-wide
                                        text-gray-700 text-xs
                                        font-bold
                                        mb-2
                                    "
                                    value="Date Hired"
                                />
                                <breeze-input
                                    id="date_hired"
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
                                    type="date"
                                    name="date_hired"
                                    v-model="date_hired"
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
                                    v-if="errors.date_hired"
                                >
                                    {{ errors.date_hired }}
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
        departments: Array,
        cities: Array,
        states: Array,
        countries: Array,
    },
    setup() {
        const form = reactive({
            first_name: "",
            last_name: "",
            middle_name: "",
            address: "",
            department_id: "",
            city_id: "",
            state_id: "",
            country_id: "",
            zip_code: "",
            birthdate: "",
            date_hired: "",
        });

        function submit() {
            Inertia.post("/employees", form);
        }

        // return
        return { ...toRefs(form), submit };
    },
};
</script>
