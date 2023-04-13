<template>
    <AppLayout title="Editar producto">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SecondaryButton @click="$inertia.get(route('spa-product.index'))" class="mb-3 flex items-center">
                    <i class="fa-solid fa-chevron-left mr-1"></i>
                    Regresar
                </SecondaryButton>
                <form @submit.prevent="update" class="my-4">
                    <div class="mb-2">
                        <InputLabel value="Nombre de producto" />
                        <input type="text" v-model="form.name" class="input w-full" required>
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="mb-2">
                        <InputLabel value="Precio" />
                        <input type="number" v-model="form.price" class="input w-full" required>
                        <InputError :message="form.errors.price" />
                    </div>
                    <div class="mb-2">
                        <InputLabel value="Cantidad" />
                        <input type="number" v-model="form.quantity" class="input w-full" required>
                        <InputError :message="form.errors.quantity" />
                    </div>
                    <div class="mb-2">
                        <InputLabel value="Descripcion" />
                        <textarea v-model="form.description" class="input w-full" required>
                        </textarea>
                        <InputError :message="form.errors.description" />
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
            description: null,
            price: null,
            quantity: null,
        });

        return {
            product: [],
            form,
        };
    },
    async mounted() {
        try {
            // get product data
            const response = await axios.get(route('product.show', 1));
            this.product = response.data;

            this.form.name = this.product.data.name;
            this.form.description = this.product.data.description;
            this.form.price = this.product.data.price;
            this.form.quantity = this.product.data.quantity;
        } catch (error) {
            console.log(error);
        };
    },
    methods: {
        update() {
            this.form.put(route('product.update', this.product.data.id), {
                onSuccess: () => this.$inertia.get(route('product.index'))
            });
        },
    },
    props: {
        product_id: Number,
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