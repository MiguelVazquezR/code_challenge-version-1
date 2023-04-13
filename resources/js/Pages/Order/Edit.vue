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
                    <div class="flex justify-end">
                        <PrimaryButton class="mt-3" :disabled="form.processing">Actualizar</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

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
            const response = await axios.get(route('order.show', 1));
            this.order = response.data;

            this.form.order_number = this.order.data.order_number;
            this.form.status_id = this.order.data.status_id;
            this.form.client_id = this.order.data.client_id;
        } catch (error) {
            console.log(error);
        };
    },
    methods: {
        update() {
            this.form.put(route('order.update', this.order.data.id), {
                onSuccess: () => this.$inertia.get(route('order.index'))
            });
        },
    },
    props: {
        order_id: Number,
    },
    components: {
        AppLayout,
        SecondaryButton,
        PrimaryButton,
        InputLabel,
        InputError,
    },
}
</script>