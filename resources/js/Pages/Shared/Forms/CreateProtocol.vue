<template>
    <div class="flex w-full justify-center bg-zinc-50 p-4 mt-4 sm:mx-4">
        <div
            class="w-full mx-auto p-8 border-2 border-black rounded shadow-xl sm:max-w-full"
        >
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-zinc-800">
                    Cadastrar Protocolo
                </h1>
                <hr class="flex-grow" />
            </div>
            <form @submit.prevent="submitProtocol">
                <div class="flex flex-col">
                    <div class="flex flex-col mb-4">
                        <label
                            for="description"
                            class="block text-sm font-bold"
                        >
                            Descrição
                        </label>
                        <textarea
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type=""
                            name="description"
                            id="description"
                            placeholder="Descrição"
                            v-model="form.description"
                            @change="form.validate('description')"
                        />
                        <span
                            v-if="form.errors.description"
                            v-text="form.errors.description"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>
                    <div
                        class="flex flex-col w-full justify-between items-center sm:flex-row sm:gap-4"
                    >
                        <div class="flex flex-col mb-4 w-full">
                            <label
                                for="deadline"
                                class="block text-sm font-bold"
                            >
                                Prazo
                            </label>
                            <input
                                class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                                type="text"
                                name="deadline"
                                id="deadline"
                                v-model="form.deadline"
                                @change="form.validate('deadline')"
                            />
                            <span
                                v-if="form.errors.deadline"
                                v-text="form.errors.deadline"
                                class="text-rose-500 text-xs mt-1 font-medium"
                            ></span>
                        </div>
                        <div class="flex flex-col mb-4 w-full">
                            <label
                                for="person_id"
                                class="block text-sm font-bold"
                            >
                                Contribuinte
                            </label>
                            <select
                                name="person_id"
                                id="person_id"
                                v-model="form.person_id"
                                class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            >
                                <option value="">Contribuinte</option>
                                <option v-for="p in people" :value="p.id">
                                    {{ p.name }}
                                </option>
                            </select>
                            <span
                                v-if="form.errors.person_id"
                                v-text="form.errors.person_id"
                                class="text-rose-500 text-xs mt-1 font-medium"
                            ></span>
                        </div>
                        <div class="flex flex-col mb-4 w-full">
                            <label
                                for="department_id"
                                class="block text-sm font-bold"
                            >
                                Departamento
                            </label>
                            <select
                                name="department_id"
                                id="department_id"
                                v-model="form.department_id"
                                class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            >
                                <option value="">Departamento</option>
                                <option v-for="d in departments" :value="d.id">
                                    {{ d.name }}
                                </option>
                            </select>
                            <span
                                v-if="form.errors.department_id"
                                v-text="form.errors.department_id"
                                class="text-rose-500 text-xs mt-1 font-medium"
                            ></span>
                        </div>
                    </div>
                    <div>
                        <label for="files" class="block text-sm font-bold">
                            Anexar Arquivos (até 5 arquivos, máximo 3 MB cada)
                        </label>
                        <input
                            type="file"
                            name="files"
                            id="files"
                            multiple
                            @change="handleFileChange"
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                        />
                        <span
                            v-if="form.errors.files || form.errors['files.0']"
                            v-text="form.errors.files || form.errors['files.0']"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full border-2 border-zinc-800 rounded-sm text-xl font-bold p-2 mt-4 bg-emerald-400 hover:bg-emerald-400/80 sm:w-1/4"
                    >
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "laravel-precognition-vue-inertia";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const props = defineProps({
    people: Array,
    departments: Array,
});

const form = useForm("post", route("store-protocol"), {
    description: "",
    deadline: "",
    person_id: "",
    department_id: "",
    files: "",
});

const submitProtocol = () => {
    form.submit({
        onSuccess: () => {
            form.reset(), toast.success("Protocolo cadastrado com sucesso!");
        },
    });
};

const handleFileChange = (event) => {
    form.files = event.target.files;
};
</script>
