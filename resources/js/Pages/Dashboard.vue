<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Estadistica from "@/Components/Estadistica.vue";
import ChartJs from "@/Components/ChartJs.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center"
            >
                Bienvenido al Sistema de la Parroquia San Antonio de Putina
            </h2>
        </template>

        <div class="w-full">
            <Estadistica>
                <template #oficina>{{
                    $page.props.auth.user.oficina_id
                }}</template>
                <template #usuario>{{ $page.props.auth.user.name }}</template>
                <template #correo>{{ $page.props.auth.user.email }}</template>
                <template #pagoTotalHoy>
                    {{ $page.props.bautizos.hoy }}
                </template>
                <template #pagosTotalesTotal>
                    {{ $page.props.bautizos.total }}</template
                >
                <template #graficos
                    ><ChartJs
                        :chart-data="[]"
                        :chart-labels="Labels"
                        chart-label="Visita de Pagos"
                        :chart-colors="Colors"
                    ></ChartJs>
                    <ChartJs
                        :chart-data="[]"
                        :chart-labels="Labels"
                        chart-label="Operaciones en caja"
                        :chart-colors="Colors2"
                    ></ChartJs>
                    <ChartJs
                        :chart-data="[]"
                        :chart-labels="Labels"
                        chart-label="Pagos Totales (S/.)"
                        :chart-colors="Colors3"
                    ></ChartJs>
                    <ChartJs
                        :chart-data="[]"
                        :chart-labels="Labels2"
                        chart-label="Pagos Totales (S/.)"
                        :chart-colors="Colors4"
                    ></ChartJs>
                </template>
            </Estadistica>
        </div>
    </AuthenticatedLayout>
</template>
