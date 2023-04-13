<template>
    <AppLayout title="Crear supplier">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SecondaryButton @click="$inertia.get(route('spa-supplier.index'))" class="mb-3 flex items-center">
                    <i class="fa-solid fa-chevron-left mr-1"></i>
                    Regresar
                </SecondaryButton>
                <form @submit.prevent="store" class="my-4">
                    <div class="mb-2">
                        <InputLabel value="Nombre de proveedor" />
                        <input type="text" v-model="form.name" class="input w-full" required>
                        <InputError :message="form.errors.name" />
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
import axios from 'axios';

export default {
    data() {
        const form = useForm({
            name: null,
        });
        
        return {
            form,
        };
    },
    methods: {
        async store() {
            // make request to store new register
            try {
                const response = await axios.post(route('supplier.store'), { name: this.form.name });

                // return to index if record created
                if(response.status == 201) {
                    this.$inertia.get(route('spa-supplier.index'));
                }
            } catch (error) {
                if(error.response.status == 422) {
                    console.log(error.response.data.errors);
                    this.form.errors = error.response.data.errors;
                }
                console.log(error);
            }
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