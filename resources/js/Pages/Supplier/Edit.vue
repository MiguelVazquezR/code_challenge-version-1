<template>
    <AppLayout title="Editar proveedor">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SecondaryButton @click="$inertia.get(route('spa-supplier.index'))" class="mb-3 flex items-center">
                    <i class="fa-solid fa-chevron-left mr-1"></i>
                    Regresar
                </SecondaryButton>
                <form @submit.prevent="update" class="my-4">
                    <div class="mb-2">
                        <InputLabel value="Nombre de proveedor" />
                        <input type="text" v-model="form.name" class="input w-full" required>
                        <InputError :message="form.errors.name" />
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
            name: null,
        });

        return {
            supplier: [],
            form,
        };
    },
    async mounted() {
        try {
            // get supplier data
            const response = await axios.get(route('supplier.show', 1));
            this.supplier = response.data;

            this.form.name = this.supplier.data.name;
        } catch (error) {
            console.log(error);
        };
    },
    methods: {
        update() {
            this.form.put(route('supplier.update', this.supplier.data.id), {
                onSuccess: () => this.$inertia.get(route('supplier.index'))
            });
        },
    },
    props: {
        supplier_id: Number,
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