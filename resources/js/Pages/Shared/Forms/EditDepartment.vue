<template>
    <div
        class="flex w-full justify-center bg-zinc-50 p-4 mt-4 sm:mx-4 sm:max-w-lg"
    >
        <div
            class="w-full mx-auto p-8 border-2 border-black rounded shadow-xl sm:max-w-full"
        >
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-zinc-800">
                    Editar Departamento
                </h1>
                <hr class="flex-grow" />
            </div>
            <form @submit.prevent="editDepartment">
                <div class="flex flex-col">
                    <div class="flex flex-col mb-4">
                        <label for="name" class="block text-sm font-bold">
                            Nome
                        </label>
                        <input
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type="text"
                            name="name"
                            id="name"
                            placeholder="Nome"
                            v-model="form.name"
                        />
                        <span
                            v-if="form.errors.name"
                            v-text="form.errors.name"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full border-2 border-zinc-800 rounded-sm text-xl font-bold p-2 mt-4 bg-emerald-400 hover:bg-emerald-400/80 sm:w-1/2"
                    >
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const props = defineProps({
    department: Object,
});

let form = useForm({
    name: props.department.name,
});

const editDepartment = () => {
    form.put(`/department/edit/${props.department.id}`, {
        onSuccess: () => {
            form.reset(), toast.warning("Departamento editado com sucesso!");
        },
    });
};
</script>
