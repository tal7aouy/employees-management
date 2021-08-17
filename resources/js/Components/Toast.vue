<template>
    <transition name="slide-fade">
        <div
            v-if="toast && visible"
            class="
                absolute
                flex
                max-w-xs
                w-full
                mt-4
                mr-4
                top-0
                right-0
                bg-white
                rounded
                shadow
                p-4
                z-50
            "
        >
            <div class="mr-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-green-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
                    />
                </svg>
            </div>
            <div class="flex-1 text-gray-800 font-medium">
                {{ toast.message }}
            </div>
            <div class="ml-2">
                <button
                    @click="visible = false"
                    class="
                        align-top
                        text-gray-500
                        hover:text-gray-700
                        focus:outline-none focus:text-indigo-600
                    "
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </transition>
</template>

<script>
import { ref, watchEffect } from "vue";
export default {
    props: {
        toast: Object,
    },

    setup() {
        const visible = ref(false);
        const timeout = ref(null);
        watchEffect(() => {
            visible.value = true;
            if (timeout) {
                clearTimeout(timeout.value);
            }
            timeout.value = setTimeout(() => {
                visible.value = false;
            }, 2000);
        });
        return { visible };
    },
};
</script>

<style scoped>
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.4s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(100px);
    opacity: 0;
}
</style>
