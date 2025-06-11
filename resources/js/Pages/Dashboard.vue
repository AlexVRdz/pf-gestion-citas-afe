<template>
    <AppLayout title="Panel Administrativo">
        <template #header>
            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between"
            >
                <h2
                    class="text-2xl font-semibold text-gray-800 dark:text-dark leading-tight"
                >
                    Panel Administrativo - Klinika
                </h2>
                <div
                    class="mt-2 md:mt-0 text-sm text-gray-600 dark:text-gray-500"
                >
                    {{ currentTime }}
                </div>
            </div>
        </template>

        <div class="py-6 sm:py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Bienvenida y resumen -->
                <div
                    class="mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6"
                >
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div>
                            <h3
                                class="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Bienvenido,
                                <span class="text-blue-600 dark:text-blue-500"
                                    >{{ user.name }} {{ user.apellidos }}</span
                                >
                            </h3>
                            <p class="text-gray-600 dark:text-gray-200 mt-1">
                                Rol:
                                <span class="font-medium">{{ user.role }}</span>
                            </p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <div class="flex space-x-3">
                                <div
                                    class="px-4 py-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-center"
                                >
                                    <p
                                        class="text-sm text-gray-500 dark:text-gray-400"
                                    >
                                        Citas hoy
                                    </p>
                                    <p
                                        class="text-xl font-bold text-blue-600 dark:text-blue-400"
                                    >
                                        12
                                    </p>
                                </div>
                                <div
                                    class="px-4 py-2 bg-green-50 dark:bg-green-900/30 rounded-lg text-center"
                                >
                                    <p
                                        class="text-sm text-gray-500 dark:text-gray-400"
                                    >
                                        Pacientes
                                    </p>
                                    <p
                                        class="text-xl font-bold text-green-600 dark:text-green-400"
                                    >
                                        48
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menú principal según rol -->
                <div class="space-y-8">
                    <!-- Menú para Admin -->
                    <div v-if="user.role === 'Admin'">
                        <!-- Sección de Administración -->
                        <div
                            class="bg-white dark:bg-gray-500 rounded-xl shadow-sm overflow-hidden p-3"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center"
                            >
                                <span
                                    class="w-2 h-6 bg-blue-600 rounded-full mr-2"
                                ></span>
                                Administración
                            </h3>
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                            >
                                <DashboardCard
                                    title="Gestión de Usuarios"
                                    icon="👥"
                                    :href="route('users.index')"
                                    color="blue"
                                />
                                <DashboardCard
                                    title="Gestión de Citas"
                                    icon="📅"
                                    :href="route('citas.index')"
                                    color="green"
                                />
                                <DashboardCard
                                    title="Estados"
                                    icon="📊"
                                    :href="route('estados.index')"
                                    color="yellow"
                                />
                            </div>
                        </div>

                        <!-- Sección de Configuración -->
                        <div
                            class="mt-8 bg-white dark:bg-gray-600 rounded-xl shadow-sm overflow-hidden p-3"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center"
                            >
                                <span
                                    class="w-2 h-6 bg-purple-600 rounded-full mr-2"
                                ></span>
                                Configuración
                            </h3>
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                            >
                                <DashboardCard
                                    title="Tipos de Pago"
                                    icon="💳"
                                    :href="route('tipo-pagos.index')"
                                    color="purple"
                                />
                                <DashboardCard
                                    title="Médicos"
                                    icon="👨‍⚕️"
                                    :href="route('medicos.index')"
                                    color="red"
                                />
                                <DashboardCard
                                    title="Tipos de Contrato"
                                    icon="📋"
                                    :href="route('tipo-contratos.index')"
                                    color="indigo"
                                />
                            </div>
                        </div>

                        <!-- Sección de Pacientes -->
                        <div
                            class="mt-8 bg-white dark:bg-gray-700 rounded-xl shadow-sm overflow-hidden p-3"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center"
                            >
                                <span
                                    class="w-2 h-6 bg-teal-600 rounded-full mr-2"
                                ></span>
                                Pacientes
                            </h3>
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                            >
                                <DashboardCard
                                    title="Historial Médico"
                                    icon="📋"
                                    :href="route('historial-medicos.index')"
                                    color="pink"
                                />
                                <DashboardCard
                                    title="Tipos de Enfermedad"
                                    icon="🦠"
                                    :href="route('tipo-enfermedades.index')"
                                    color="orange"
                                />
                                <DashboardCard
                                    title="Pacientes"
                                    icon="🏥"
                                    :href="route('pacientes.index')"
                                    color="teal"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Menú para Doctor -->
                    <div v-if="user.role === 'Doctor'">
                        <!-- Panel del Doctor -->
                        <div
                            class="bg-white dark:bg-gray-500 rounded-xl shadow-sm overflow-hidden p-3"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center"
                            >
                                <span
                                    class="w-2 h-6 bg-green-600 rounded-full mr-2"
                                ></span>
                                Panel del Doctor
                            </h3>
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"
                            >
                                <DashboardCard
                                    title="Mis Citas"
                                    icon="📅"
                                    :href="route('citas.index')"
                                    color="green"
                                />
                                <DashboardCard
                                    title="Mis Pacientes"
                                    icon="🏥"
                                    :href="route('pacientes.index')"
                                    color="teal"
                                />
                                <DashboardCard
                                    title="Historial Médico"
                                    icon="📋"
                                    :href="route('historial-medicos.index')"
                                    color="pink"
                                />
                                <DashboardCard
                                    title="Tipos de Enfermedad"
                                    icon="🦠"
                                    :href="route('tipo-enfermedades.index')"
                                    color="orange"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Menú para Secretaria -->
                    <div v-if="user.role === 'Secretaria'">
                        <!-- Panel de Secretaría -->
                        <div
                            class="bg-white dark:bg-gray-500 rounded-xl shadow-sm overflow-hidden p-3"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center"
                            >
                                <span
                                    class="w-2 h-6 bg-indigo-600 rounded-full mr-2"
                                ></span>
                                Panel de Secretaría
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <DashboardCard
                                    title="Gestión de Citas"
                                    icon="📅"
                                    :href="route('citas.index')"
                                    color="green"
                                />
                                <DashboardCard
                                    title="Pacientes"
                                    icon="🏥"
                                    :href="route('pacientes.index')"
                                    color="teal"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resumen rápido (solo para Admin) -->
                <div
                    v-if="user.role === 'Admin'"
                    class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6"
                >
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6"
                    >
                        <h3
                            class="text-lg font-semibold text-gray-900 dark:text-white mb-4"
                        >
                            Citas recientes
                        </h3>
                        <div
                            class="text-center py-8 text-gray-400 dark:text-gray-500"
                        >
                            <p>Lista de citas recientes</p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6"
                    >
                        <h3
                            class="text-lg font-semibold text-gray-900 dark:text-white mb-4"
                        >
                            Actividad reciente
                        </h3>
                        <div
                            class="text-center py-8 text-gray-400 dark:text-gray-500"
                        >
                            <p>Registro de actividad</p>
                        </div>
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
import DashboardCard from "@/Components/DashboardCard.vue";

defineProps({
    user: Object,
    role: String,
});

const currentTime = ref("");

const updateTime = () => {
    const now = new Date();
    currentTime.value = now.toLocaleString("es-ES", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
};

onMounted(() => {
    updateTime();
    setInterval(updateTime, 1000);
});
</script>
