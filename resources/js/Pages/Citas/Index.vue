<template>
    <AppLayout title="Gestión de Usuarios">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de Citas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <div class="mb-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">
                                Estás en la vista: Gestión de Citas
                            </h3>
                            <p class="text-sm text-gray-600">
                                Usuario: {{ user.name }} {{ user.apellidos }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Hora actual: {{ currentTime }}
                            </p>
                        </div>
                        <Link
                            :href="route('users.create')"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Crear Cita
                        </Link>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Paciente
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Fecha y Hora
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Médico
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Estado
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="appointment in appointments"
                                    :key="appointment.id"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            {{ appointment.paciente.nombre }}
                                            {{ appointment.paciente.apellidos }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{
                                                new Date(
                                                    appointment.fecha_hora
                                                ).toLocaleString("es-ES")
                                            }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ appointment.medico.nombre }}
                                            {{ appointment.medico.apellidos }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            :class="{
                                                'bg-green-100 text-green-800':
                                                    appointment.estado ===
                                                    'Confirmada',
                                                'bg-yellow-100 text-yellow-800':
                                                    appointment.estado ===
                                                    'Pendiente',
                                                'bg-red-100 text-red-800':
                                                    appointment.estado ===
                                                    'Cancelada',
                                            }"
                                        >
                                            {{ appointment.estado }}
                                        </span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                    >
                                        <Link
                                            :href="
                                                route(
                                                    'appointments.show',
                                                    appointment.id
                                                )
                                            "
                                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                                        >
                                            Ver
                                        </Link>
                                        <Link
                                            :href="
                                                route(
                                                    'appointments.edit',
                                                    appointment.id
                                                )
                                            "
                                            class="text-yellow-600 hover:text-yellow-900 mr-3"
                                        >
                                            Editar
                                        </Link>
                                        <button
                                            @click="
                                                deleteAppointment(
                                                    appointment.id
                                                )
                                            "
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, router } from "@inertiajs/vue3";

defineProps({
    users: Array,
    user: Object,
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

const deleteUser = (id) => {
    if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
        router.delete(route("users.destroy", id));
    }
};

onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);
});
</script>
