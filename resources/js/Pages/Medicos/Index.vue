<template>
    <AppLayout title="Gestión de Médicos">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Gestión de Médicos
        </h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="mb-6 flex justify-between items-center">
              <div>
                <h3 class="text-lg font-medium text-gray-900">Vista: Médicos registrados</h3>
                <p class="text-sm text-gray-600">Hora actual: {{ currentTime }}</p>
              </div>
              <Link
                :href="route('medicos.create')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2"
              >
                ➕ Registrar Médico
              </Link>
            </div>
  
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Especialidad</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contrato</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cédula</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="medico in medicos.data" :key="medico.id">
                    <td class="px-6 py-4 text-sm text-gray-900">
                      {{ medico.user.name }} {{ medico.user.apellidos }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ medico.especialidad }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ medico.tipo_contrato?.nombre || 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ medico.cedula_profesional }}</td>
                    <td class="px-6 py-4 text-sm font-medium flex gap-3">
                      <Link :href="route('medicos.show', medico.id)" class="text-indigo-600 hover:text-indigo-900">👁 Ver</Link>
                      <Link :href="route('medicos.edit', medico.id)" class="text-yellow-600 hover:text-yellow-900">✏️ Editar</Link>
                      <button
                        @click="eliminarMedico(medico.id)"
                        :disabled="deleting.includes(medico.id)"
                        class="text-red-600 hover:text-red-900 disabled:opacity-50"
                      >
                        <span v-if="deleting.includes(medico.id)">🕑 Eliminando...</span>
                        <span v-else>🗑 Eliminar</span>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
  
              <!-- Paginación -->
              <div v-if="medicos.links?.length > 3" class="mt-6 flex gap-2">
                <template v-for="(link, index) in medicos.links" :key="index">
                  <Link
                    v-if="link.url"
                    :href="link.url"
                    v-html="link.label"
                    class="px-3 py-1 rounded text-sm"
                    :class="link.active ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-800'"
                  />
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AppLayout>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import { Link, router } from "@inertiajs/vue3";
  import AppLayout from "@/Layouts/AppLayout.vue";
  
  const props = defineProps({
    medicos: Object,
  });
  
  const currentTime = ref("");
  const deleting = ref([]);
  
  const updateTime = () => {
    const now = new Date();
    currentTime.value = now.toLocaleString("es-ES", {
      year: "numeric",
      month: "long",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
    });
  };
  
  const eliminarMedico = (id) => {
    if (confirm("¿Deseas eliminar este médico?")) {
      deleting.value.push(id);
      router.delete(route("medicos.destroy", id), {
        onFinish: () => {
          deleting.value = deleting.value.filter((i) => i !== id);
        },
      });
    }
  };
  
  onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);
  });
  </script>
  