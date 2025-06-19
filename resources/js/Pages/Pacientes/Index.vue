<template>
  <AppLayout title="Gestión de Pacientes">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Gestión de Pacientes
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded p-6">
          <!--  Buscador -->
          <div class="mb-4">
            <input
              v-model="search"
              @keyup.enter="submitSearch"
              placeholder="Buscar paciente..."
              class="border border-gray-300 rounded px-4 py-2 w-1/2"
            />
            <button
              @click="submitSearch"
              class="ml-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            >
              Buscar
            </button>
          </div>

          <!--  Tabla de pacientes -->
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellidos</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="paciente in pacientes.data" :key="paciente.id">
  <td class="px-6 py-4 whitespace-nowrap">{{ paciente?.nombre || 'N/A' }}</td>
  <td class="px-6 py-4 whitespace-nowrap">{{ paciente?.apellidos || 'N/A' }}</td>
  <td class="px-6 py-4 whitespace-nowrap">{{ paciente?.email || 'Sin correo' }}</td>
</tr>

            </tbody>
          </table>

          <!--  Paginación -->
            
          <div class="mt-4 flex justify-center gap-2">
            <button
              v-for="link in pacientes.links"
              :key="link.label"
              v-html="link.label"
              @click="goToPage(link.url)"
              :disabled="!link.url"
              class="px-3 py-1 border rounded text-sm"
              :class="{
                'bg-blue-500 text-white': link.active,
                'text-gray-500': !link.url,
              }"
            ></button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  pacientes: {
    type: Object,
    default: () => ({ data: [], links: [] }),
  },
  busqueda: {
    type: String,
    default: '',
  },
});


const search = ref('');
search.value = $props.busqueda ?? '';

const submitSearch = () => {
  router.get(route('pacientes.index'), {
    buscar: search.value,
  }, {
    preserveState: true,
    replace: true,
  });
};

const goToPage = (url) => {
  if (url) router.visit(url);
};
</script>
