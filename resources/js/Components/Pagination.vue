<script setup>
import { computed } from "vue";
import { router } from "@inertiajs/vue3";

defineProps({
    links: Array,
});

const goToPage = (url) => {
    if (url) router.get(url);
};
</script>

<template>
    <nav class="flex justify-center mt-4">
        <ul class="flex space-x-2">
            <li
                v-for="(link, index) in links"
                :key="index"
                class="px-4 py-2 rounded-md"
                :class="{
                    'bg-gray-200': link.active,
                    'cursor-pointer': link.url,
                }"
                @click="goToPage(link.url)"
            >
                <span v-html="link.label"></span>
            </li>
        </ul>
    </nav>
</template>

<style scoped>
li {
    border: 1px solid #ddd;
}
</style>
