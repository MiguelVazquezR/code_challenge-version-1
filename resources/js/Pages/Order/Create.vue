<template>
    <AppLayout title="Crear orden">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SecondaryButton @click="$inertia.get(route('spa-order.index'))" class="mb-3 flex items-center">
                    <i class="fa-solid fa-chevron-left mr-1"></i>
                    Regresar
                </SecondaryButton>
                <form @submit.prevent="store" class="my-4">
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
                            <option v-for="(client, index) in clients.data" :key="index" :value="client.id">{{ client.name }}</option>
                        </select>
                        <InputError :message="form.errors.client_id" />
                    </div>
                    <div class="flex justify-end">
                        <PrimaryButton class="mt-3" :disabled="form.processing">Crear</PrimaryButton>
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
            form,
        };
    },
    async mounted() {
        try {
            const response = await axios.get(route('client.index'));
            this.clients = response.data;
        } catch (error) {
            console.log(error);
        }
    },
    methods: {
        store() {
            this.form.post(route('order.store'), {
                onSuccess: () => this.$inertia.get(route('order.index'))
            });
        }
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