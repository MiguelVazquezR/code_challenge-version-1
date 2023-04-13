<template>
    <AppLayout title="Clientes">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end">
                    <PrimaryButton @click="$inertia.get(route('spa-client.create'))" class="mb-3">Crear</PrimaryButton>
                </div>
                <div @click="$inertia.get(route('spa-client.edit', client))" v-for="client in clients.data" :key="client.id" class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-2 mb-3 cursor-pointer hover:bg-indigo-200">                   
                    ID: {{ client.id }} | Nombre: {{ client.name }}
                </div>
                <p v-if="clients?.data?.length === 0" class="text-gray-500 text-sm text-center mt-4">No hay elementos para mostrar</p>
            </div>
        </div>
    </AppLayout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

export default {
    data(){
        return {
            clients: [],
        };
    },
    components: {
        AppLayout,
        PrimaryButton,
    },
    async mounted() {
        try {
            const response = await axios.get(route('client.index'));
            this.clients = response.data;
        } catch (error) {
            console.log(error);
        }
    }
}
</script>