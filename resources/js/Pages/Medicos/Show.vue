<template>
    <AppLayout title="Detalles del Médico">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Detalles del Médico
        </h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!-- Header -->
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
              <div>
                <h3 class="text-lg font-medium text-gray-900">
                  {{ medico.user.name }} {{ medico.user.apellidos }}
                </h3>
                <p class="text-sm text-gray-600">Correo: {{ medico.user.email }}</p>
                <p class="text-sm text-gray-600">Teléfono: {{ medico.user.telefono }}</p>
                <p class="text-sm text-gray-600">Hora actual: {{ currentTime }}</p>
              </div>
              <div class="flex gap-3">
                <Link :href="route('medicos.edit', medico.id)" class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded">
                  ✏️ Editar
                </Link>
                <Link :href="route('medicos.index')" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">
                  ← Volver
                </Link>
              </div>
            </div>
  
            <!-- Información general -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Especialidad</label>
                <div class="p-3 bg-gray-100 rounded-md">
                  {{ medico.especialidad }}
                </div>
              </div>
  
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cédula Profesional</label>
                <div class="p-3 bg-gray-100 rounded-md">
                  {{ medico.cedula_profesional }}
                </div>
              </div>
  
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Contrato</label>
                <div class="p-3 bg-gray-100 rounded-md">
                  {{ medico.tipo_contrato?.nombre || 'N/A' }}
                </div>
              </div>
  
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de creación</label>
                <div class="p-3 bg-gray-100 rounded-md">
                  {{ formatDate(medico.created_at) }}
                </div>
              </div>
            </div>
  
            <!-- Citas -->
            <div v-if="medico.citas?.length" class="px-6 pt-8 pb-6">
              <h4 class="text-lg font-medium mb-2">Citas registradas</h4>
              <ul class="divide-y">
                <li v-for="cita in medico.citas" :key="cita.id" class="py-3">
                  <div class="text-sm text-gray-700">
                    📅 {{ formatDate(cita.fecha_hora) }} — Paciente: {{ cita.paciente?.nombre }} {{ cita.paciente?.apellidos }}
                  </div>
                  <div class="text-xs text-gray-500">Motivo: {{ cita.motivo }}</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </AppLayout>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import { Link } from "@inertiajs/vue3";
  
  const props = defineProps({
    medico: {
      type: Object,
      required: true
    }
  });
  
  const currentTime = ref("");
  
  const updateTime = () => {
    const now = new Date();
    currentTime.value = now.toLocaleString("es-ES", {
      year: "numeric",
      month: "long",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit"
    });
  };
  
  const formatDate = (dateStr) => {
    if (!dateStr) return "N/A";
    return new Date(dateStr).toLocaleDateString("es-ES", {
      year: "numeric",
      month: "long",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit"
    });
  };
  
  onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);
  });
  </script>
  