<template>
    <AppLayout title="Editar orden">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SecondaryButton @click="$inertia.get(route('spa-order.index'))" class="mb-3 flex items-center">
                    <i class="fa-solid fa-chevron-left mr-1"></i>
                    Regresar
                </SecondaryButton>
                <form @submit.prevent="update" class="my-4">
                    <div class="mb-2">
                        <InputLabel value="Numero de orden" />
                        <input type="text" v-model="form.order_number" class="input w-full" required>
                        <InputError :message="form.errors.order_number" />
                    </div>
                    <div class="mb-2">
                        <InputLabel value="Status" />
                        <input type="text" v-model="form.status_id" class="input w-full" required>
                        <InputError :message="form.errors.status_id" />
                    </div>
                    <div class="mb-2">
                        <InputLabel value="cliente" />
                        <select v-model="form.client_id" class="input w-full" required>
                            <option v-for="(client, index) in clients.data" :key="index" :value="client.id">{{ client.name
                            }}</option>
                        </select>
                        <InputError :message="form.errors.client_id" />
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
            order_number: null,
            status_id: null,
            client_id: null,
        });

        return {
            clients: [],
            order: [],
            form,
            show_confirmation: false,
        };
    },
    async mounted() {
        try {
            // get clients data
            let response = await axios.get(route('client.index'));
            this.clients = response.data;
        } catch (error) {
            console.log(error);
        };

        try {
            // get order data
            const response = await axios.get(route('order.show', this.order_id));
            this.order = response.data;

            this.form.order_number = this.order.data.order_number;
            this.form.status_id = this.order.data.status_id;
            this.form.client_id = this.order.data.client_id;
        } catch (error) {
            console.log(error);
        };
    },
    methods: {
        async update() {
            // make request to store new register
            try {
                const response = await axios.put(route('order.update', this.order_id), { 
                    order_number: this.form.order_number,
                    status_id: this.form.status_id,
                    client_id: this.form.client_id,
                });

                // return to index if record updated correctly
                if(response.status == 200) {
                    this.$inertia.get(route('spa-order.index'));
                }
            } catch (error) {
                if(error.response.status == 422) {
                    console.log(error.response.data.errors);
                    this.form.errors = error.response.data.errors;
                }
                console.log(error);
            }
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
        order_id: String,
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