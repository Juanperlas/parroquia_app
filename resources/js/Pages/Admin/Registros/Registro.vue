<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps(["registros"]);
const form = useForm({});
const showConfirmDeleteUserModal = ref(false);
const showConfirmDeletePagoModal = ref(false);
const selectedPagoId = ref(null);

const abrirConstancia = (id) => {
    window.open(`/registros/${id}/constancia`, "_blank");
};

const confirmDeleteUser = () => {
    showConfirmDeleteUserModal.value = true;
};

const confirmDeletePago = (idPago) => {
    selectedPagoId.value = idPago;
    showConfirmDeletePagoModal.value = true;
};

const closeModal = () => {
    showConfirmDeleteUserModal.value = false;
    showConfirmDeletePagoModal.value = false;
};

const deletePago = () => {
    if (selectedPagoId.value) {
        form.delete(route("registros.destroy", selectedPagoId.value), {
            onSuccess: () => closeModal(),
        });
    }
};

const deleteUser = (id) => {
    form.delete(route("users.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
</script>

<template>
    <Head title="Registros" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1 class="font-extrabold text-2xl">Registros</h1>
                <Link
                    :href="route('registros.create')"
                    class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
                    >Nuevo Registro</Link
                >
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeaderCell>N°</TableHeaderCell>
                            <TableHeaderCell>Nombre</TableHeaderCell>
                            <TableHeaderCell>Lugar</TableHeaderCell>
                            <TableHeaderCell>Sacerdote</TableHeaderCell>
                            <TableHeaderCell>Fecha</TableHeaderCell>
                            <TableHeaderCell>Opciones</TableHeaderCell>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow
                            v-for="registro in registros"
                            :key="registro.numero_registro"
                            class="border-b"
                        >
                            <TableDataCell>{{
                                registro.numero_registro
                            }}</TableDataCell>
                            <TableDataCell>{{ registro.nombre }}</TableDataCell>
                            <TableDataCell>{{
                                registro.lugar_bautizo
                            }}</TableDataCell>
                            <TableDataCell>{{
                                registro.sacerdote
                            }}</TableDataCell>
                            <TableDataCell>{{
                                registro.fecha_bautizo
                            }}</TableDataCell>
                            <TableDataCell>
                                <button
                                    @click="
                                        confirmDeletePago(
                                            registro.numero_registro
                                        )
                                    "
                                    class="text-red-400 hover:text-red-600"
                                >
                                    <DangerButton>Eliminar</DangerButton>
                                </button>
                                <Modal
                                    :show="showConfirmDeletePagoModal"
                                    @close="closeModal"
                                >
                                    <div class="p-6">
                                        <h2
                                            class="text-lg font-semibold text-slate-800"
                                        >
                                            ¿Estás seguro de eliminar el pago?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton
                                                @click="
                                                    deletePago(
                                                        registro.numero_registro
                                                    )
                                                "
                                                >Eliminar</DangerButton
                                            >
                                            <SecondaryButton @click="closeModal"
                                                >Cancelar</SecondaryButton
                                            >
                                        </div>
                                    </div>
                                </Modal>
                                <PrimaryButton
                                    @click="
                                        abrirConstancia(
                                            registro.numero_registro
                                        )
                                    "
                                    class="mx-2"
                                    >BOLETA</PrimaryButton
                                >
                                <button
                                    @click="
                                        editRegistro(registro.numero_registro)
                                    "
                                    class="text-green-400 hover:text-green-600"
                                >
                                    <i class="fas fa-pencil-alt"></i>
                                    <!-- Reemplaza con el código del ícono de lápiz -->
                                </button>
                                <Link
                                    :href="
                                        route(
                                            'registros.edit',
                                            registro.numero_registro
                                        )
                                    "
                                    class="hover:-translate-y-1 hover:scale-110 transition ease-in-out delay-50 bg-green-500 shadow-lg shadow-green-500/50 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                    >EDITAR</Link
                                >
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
