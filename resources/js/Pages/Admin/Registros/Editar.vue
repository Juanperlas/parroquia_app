<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref, onMounted } from "vue";

const props = defineProps({
    registro: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    nombre: null,
    padre: null,
    madre: null,
    padrino: null,
    madrina: null,
    fecha_bautizo: null,
    lugar_bautizo: null,
    sacerdote: null,
});

// Llenar el formulario con los datos proporcionados en la prop registro
onMounted(() => {
    form.nombre = props.registro.nombre || null;
    form.padre = props.registro.padre || null;
    form.madre = props.registro.madre || null;
    form.padrino = props.registro.padrino || null;
    form.madrina = props.registro.madrina || null;
    form.fecha_bautizo = props.registro.fecha_bautizo || null;
    form.lugar_bautizo = props.registro.lugar_bautizo || null;
    form.sacerdote = props.registro.sacerdote || null;
    console.log(form.padre);
});
</script>

<template>
    <Head title="Editar Registro de Bautizo" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <Link
                    :href="route('registros.index')"
                    class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
                    >Atrás</Link
                >
            </div>
            <div
                class="mt-6 max-w-md mx-auto bg-slate-100 shadow-lg rounded-lg p-6"
            >
                <h1 class="text-2xl p-4">Editar Registro de Bautizo</h1>
                <form
                    @submit.prevent="
                        form.put(
                            route('registros.update', registro.numero_registro)
                        )
                    "
                >
                    <!-- Nombre -->
                    <div>
                        <InputLabel for="nombre" value="Nombre" />
                        <TextInput
                            id="nombre"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.nombre"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.nombre"
                        />
                    </div>

                    <!-- Padre -->
                    <div>
                        <InputLabel for="padre" value="Padre" />
                        <TextInput
                            id="padre"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.padre"
                        />
                        <InputError class="mt-2" :message="form.errors.padre" />
                    </div>

                    <!-- Madre -->
                    <div>
                        <InputLabel for="madre" value="Madre" />
                        <TextInput
                            id="madre"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.madre"
                        />
                        <InputError class="mt-2" :message="form.errors.madre" />
                    </div>

                    <!-- Padrino -->
                    <div>
                        <InputLabel for="padrino" value="Padrino" />
                        <TextInput
                            id="padrino"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.padrino"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.padrino"
                        />
                    </div>

                    <!-- Madrina -->
                    <div>
                        <InputLabel for="madrina" value="Madrina" />
                        <TextInput
                            id="madrina"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.madrina"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.madrina"
                        />
                    </div>

                    <!-- Fecha de Bautizo -->
                    <div>
                        <InputLabel
                            for="fecha_bautizo"
                            value="Fecha de Bautizo"
                        />
                        <TextInput
                            id="fecha_bautizo"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.fecha_bautizo"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.fecha_bautizo"
                        />
                    </div>

                    <!-- Lugar de Bautizo -->
                    <div>
                        <InputLabel
                            for="lugar_bautizo"
                            value="Lugar de Bautizo"
                        />
                        <TextInput
                            id="lugar_bautizo"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.lugar_bautizo"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.lugar_bautizo"
                        />
                    </div>

                    <!-- Sacerdote -->
                    <div>
                        <InputLabel for="sacerdote" value="Sacerdote" />
                        <TextInput
                            id="sacerdote"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.sacerdote"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.sacerdote"
                        />
                    </div>

                    <div class="flex items-center mt-4">
                        <PrimaryButton
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Actualizar
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
