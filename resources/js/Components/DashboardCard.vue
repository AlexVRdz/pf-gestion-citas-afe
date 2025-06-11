<template>
    <Link
        :href="href"
        class="flex items-center p-4 rounded-lg transition-all hover:shadow-md"
        :class="[
            `hover:bg-${color}-50 dark:hover:bg-${color}-900/20`,
            `border-l-4 border-${color}-500`,
        ]"
    >
        <span class="text-2xl mr-4">{{ icon }}</span>
        <span class="font-medium text-gray-700 dark:text-gray-300">{{
            title
        }}</span>
        <span class="ml-auto text-gray-400">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"
                />
            </svg>
        </span>
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    title: String,
    icon: String,
    href: String,
    color: {
        type: String,
        default: "blue",
    },
});
</script>
