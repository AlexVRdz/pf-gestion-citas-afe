<template>
  <AppLayout title="Detalle de Paciente">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Detalles del Paciente
      </h2>
    </template>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Información del Paciente</h3>
        <p><strong>Nombre:</strong> {{ paciente?.nombre || 'N/A' }}</p>
        <p><strong>Apellidos:</strong> {{ paciente?.apellidos || 'N/A' }}</p>
        <p><strong>Correo:</strong> {{ paciente?.email || 'N/A' }}</p>
        <p><strong>Teléfono:</strong> {{ paciente?.telefono || 'N/A' }}</p>
        <p><strong>Dirección:</strong> {{ paciente?.direccion || 'N/A' }}</p>
        <p><strong>Fecha de nacimiento:</strong> {{ paciente?.fecha_nacimiento || 'N/A' }}</p>
        <p><strong>Género:</strong> {{ paciente?.genero || 'N/A' }}</p>
        <p><strong>Número de seguro:</strong> {{ paciente?.numero_seguro || 'N/A' }}</p>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  paciente: {
    type: Object,
    default: () => ({}),
  },
});
</script>
