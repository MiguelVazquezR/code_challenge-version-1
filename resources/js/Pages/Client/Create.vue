<template>
    <AppLayout title="Crear Cliente">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SecondaryButton @click="$inertia.get(route('spa-client.index'))" class="mb-3 flex items-center">
                    <i class="fa-solid fa-chevron-left mr-1"></i>
                    Regresar
                </SecondaryButton>
                <form @submit.prevent="store" class="my-4">
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
            name: null,
            lastname: null,
            email: null,
        });
        
        return {
            form,
        };
    },
    methods: {
        store() {
            this.form.post(route('client.store'), {
                onSuccess: () => this.$inertia.get(route('client.index'))
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