<template>
    <AppLayout title="Historial Médico">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Historial Médico</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded-lg shadow">
                <!--  Buscador -->
                <div class="mb-4">
                    <input
                        type="text"
                        v-model="search"
                        placeholder="Buscar paciente o enfermedad..."
                        class="border border-gray-300 rounded px-4 py-2 w-1/2"
                        @keyup.enter="submitSearch"
                    />
                    <button
                        @click="submitSearch"
                        class="ml-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    >
                        Buscar
                    </button>
                </div>

                <!-- Tabla -->
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Enfermedad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="item in historial.data" :key="item.id">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ item.paciente.nombre }} {{ item.paciente.apellidos }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ item.tipo_enfermedad.nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ item.observaciones }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!--  Paginación -->
                <div class="mt-6 flex justify-center gap-2">
                    <button
                        v-for="link in historial.links"
                        :key="link.label"
                        :disabled="!link.url"
                        @click="router.get(link.url)"
                        v-html="link.label"
                        class="px-3 py-1 border rounded text-sm"
                        :class="{
                            'bg-blue-500 text-white': link.active,
                            'text-gray-500': !link.url,
                        }"
                    ></button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    historial: Object,
    busqueda: String,
});

const search = ref('');
const submitSearch = () => {
    router.get(route('historial-medicos.index'), {
        buscar: search.value,
    }, {
        preserveState: true,
        replace: true,
    });
};
</script>
