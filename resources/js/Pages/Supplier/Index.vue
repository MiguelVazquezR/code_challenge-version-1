<template>
    <AppLayout title="Proveedores">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end">
                    <PrimaryButton @click="$inertia.get(route('spa-supplier.create'))" class="mb-3">Crear</PrimaryButton>
                </div>
                <div @click="$inertia.get(route('spa-supplier.edit', supplier))" v-for="supplier in suppliers.data" :key="supplier.id" class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-2 mb-3 cursor-pointer hover:bg-indigo-200">                   
                    ID: {{ supplier.id }} | Nombre: {{ supplier.name }}
                </div>
                <p v-if="suppliers?.data?.length === 0" class="text-gray-500 text-sm text-center mt-4">No hay elementos para mostrar</p>
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
            suppliers: [],
        };
    },
    components: {
        AppLayout,
        PrimaryButton,
    },
    async mounted() {
        try {
            const response = await axios.get(route('supplier.index'));
            this.suppliers = response.data;
        } catch (error) {
            console.log(error);
        }
    }
}
</script>