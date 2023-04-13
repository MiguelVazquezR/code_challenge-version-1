<template>
    <AppLayout title="Editar Cliente">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SecondaryButton @click="$inertia.get(route('spa-client.index'))" class="mb-3 flex items-center">
                    <i class="fa-solid fa-chevron-left mr-1"></i>
                    Regresar
                </SecondaryButton>
                <form @submit.prevent="update" class="my-4">
                    <div class="mb-2">
                        <InputLabel value="Nombre de cliente" />
                        <input type="text" v-model="form.name" class="input w-full" required>
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="mb-2">
                        <InputLabel value="Apellido" />
                        <input type="text" v-model="form.lastname" class="input w-full" required>
                        <InputError :message="form.errors.lastname" />
                    </div>
                    <div class="mb-2">
                        <InputLabel value="Correo" />
                        <input type="email" v-model="form.email" class="input w-full" required>
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="flex justify-end mt-3">
                        <DangerButton @click="show_confirmation = true">Eliminar</DangerButton>
                        <PrimaryButton class="ml-1" :disabled="form.processing">Actualizar</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
        <!-- confirmation modal -->
        <ConfirmationModal :show="show_confirmation" @close="show_confirmation = false">
            <template #title>
                Eliminar registro
            </template>
            <template #content>
                ¿Desea continuar con la eliminación?
            </template>
            <template #footer>
                <DangerButton @click="deleteItem">Eliminar</DangerButton>
                <SecondaryButton @click="show_confirmation = false" class="ml-1">Cancelar
                </SecondaryButton>
            </template>
        </ConfirmationModal>
    </AppLayout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import axios from 'axios';

export default {
    data() {
        const form = useForm({
            name: null,
            lastname: null,
            email: null,
        });

        return {
            form,
            show_confirmation: false,
        };
    },
    async mounted() {
        try {
            // get client data
            const response = await axios.get(route('client.show', this.client_id));
            this.client = response.data;

            this.form.name = this.client.data.name;
            this.form.lastname = this.client.data.lastname;
            this.form.email = this.client.data.email;
        } catch (error) {
            console.log(error);
        };
    },
    methods: {
        update() {
            this.form.put(route('client.update', this.client.data.id), {
                onSuccess: () => this.$inertia.get(route('client.index'))
            });
        },
        async deleteItem() {
            try {
                await axios.delete(route('product.destroy', this.product.data.id));
                this.show_confirmation = false;
                this.$inertia.get(route('spa-product.index'));
            } catch (error) {
                console.log(error);
            }
        },
    },
    props: {
        client_id: String,
    },
    components: {
        AppLayout,
        SecondaryButton,
        PrimaryButton,
        InputLabel,
        InputError,
        DangerButton,
        ConfirmationModal
    },
}
</script>