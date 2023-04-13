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
            description: null,
            price: null,
            quantity: null,
        });

        return {
            product: [],
            form,
            show_confirmation: false,
        };
    },
    async mounted() {
        try {
            // get product data
            const response = await axios.get(route('product.show', this.product_id));
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
        async update() {
            // make request to store new register
            try {
                const response = await axios.put(route('product.update', this.product_id), { 
                    name: this.form.name,
                    description: this.form.description,
                    price: this.form.price,
                    quantity: this.form.quantity,
                });

                // return to index if record updated correctly
                if(response.status == 200) {
                    this.$inertia.get(route('spa-product.index'));
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
        }
    },
    props: {
        product_id: String,
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