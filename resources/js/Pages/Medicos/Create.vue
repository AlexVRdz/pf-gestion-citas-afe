<template>
    <AppLayout title="Registrar Médico">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Crear Nuevo Médico
        </h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="mb-6">
              <h3 class="text-lg font-medium text-gray-900">Nuevo Médico</h3>
              <p class="text-sm text-gray-600">Usuario: {{ user.name }} {{ user.apellidos }}</p>
              <p class="text-sm text-gray-600">Hora actual: {{ currentTime }}</p>
            </div>
  
            <form @submit.prevent="submit" class="space-y-6">
              <!-- Usuario doctor -->
              <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Usuario</label>
                <select
                  id="user_id"
                  v-model="form.user_id"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                  :class="{ 'border-red-300': form.errors.user_id }"
                  required
                >
                  <option value="">Seleccione un usuario</option>
                  <option v-for="doctor in doctores" :key="doctor.id" :value="doctor.id">
                    {{ doctor.name }} {{ doctor.apellidos }}
                  </option>
                </select>
                <div v-if="form.errors.user_id" class="mt-2 text-sm text-red-600">{{ form.errors.user_id }}</div>
              </div>
  
              <!-- Especialidad -->
              <div>
                <label for="especialidad" class="block text-sm font-medium text-gray-700">Especialidad</label>
                <input
                  id="especialidad"
                  v-model="form.especialidad"
                  type="text"
                  placeholder="Ej: Cardiología, Pediatría..."
                  maxlength="100"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                  :class="{ 'border-red-300': form.errors.especialidad }"
                  required
                />
                <div v-if="form.errors.especialidad" class="mt-2 text-sm text-red-600">{{ form.errors.especialidad }}</div>
              </div>
  
              <!-- Cédula profesional -->
              <div>
                <label for="cedula_profesional" class="block text-sm font-medium text-gray-700">Cédula Profesional</label>
                <input
                  id="cedula_profesional"
                  v-model="form.cedula_profesional"
                  type="text"
                  maxlength="20"
                  placeholder="Ej: CP12345"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                  :class="{ 'border-red-300': form.errors.cedula_profesional }"
                  required
                />
                <div v-if="form.errors.cedula_profesional" class="mt-2 text-sm text-red-600">
                  {{ form.errors.cedula_profesional }}
                </div>
              </div>
  
              <!-- Tipo de contrato -->
              <div>
                <label for="tipo_contrato_id" class="block text-sm font-medium text-gray-700">Tipo de Contrato</label>
                <select
                  id="tipo_contrato_id"
                  v-model="form.tipo_contrato_id"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                  :class="{ 'border-red-300': form.errors.tipo_contrato_id }"
                  required
                >
                  <option value="">Seleccione un contrato</option>
                  <option v-for="contrato in contratos" :key="contrato.id" :value="contrato.id">
                    {{ contrato.nombre }}
                  </option>
                </select>
                <div v-if="form.errors.tipo_contrato_id" class="mt-2 text-sm text-red-600">
                  {{ form.errors.tipo_contrato_id }}
                </div>
              </div>
  
              <!-- Botones -->
              <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <Link :href="route('medicos.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                  ← Cancelar
                </Link>
                <button
                  type="submit"
                  :disabled="form.processing"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded disabled:opacity-50"
                >
                  ✔
                  <span v-if="form.processing">Guardando...</span>
                  <span v-else>Guardar</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </AppLayout>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import { useForm, Link } from "@inertiajs/vue3";
  import AppLayout from "@/Layouts/AppLayout.vue";
  
  const props = defineProps({
    user: Object,
    doctores: Array,
    contratos: Array,
    errors: Object,
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
      second: "2-digit",
    });
  };
  
  const form = useForm({
    user_id: "",
    especialidad: "",
    cedula_profesional: "",
    tipo_contrato_id: "",
  });
  
  const submit = () => {
    form.post(route("medicos.store"));
  };
  
  onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);
  });
  </script>
  