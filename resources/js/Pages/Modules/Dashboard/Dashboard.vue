<template>
    <div class="min-vh-100 d-flex flex-column pt-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-4 text-white">Convert Your CSV Homeowner Data</h2>

                            <form @submit.prevent="submitForm" enctype="multipart/form-data">
                                <div class="mb-4">
                                    <div class="custom-file-upload">
                                        <input
                                            type="file"
                                            class="form-control"
                                            accept=".csv"
                                            @input="form.file = $event.target.files[0]"
                                            :disabled="form.processing"
                                            ref="fileInput"
                                        >
                                        <small class="text-white d-block mt-2">
                                            Only CSV files are accepted
                                        </small>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-lg"
                                        :disabled="!form.file || form.processing"
                                    >
                                        <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status"></span>
                                        {{ form.processing ? 'Processing...' : 'Upload' }}
                                    </button>
                                </div>

                                <div v-if="form.errors.file" class="alert alert-danger mt-3">
                                    {{ form.errors.file }}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row shadow-lg">
                <div class="col-12">
                    <DynamicTable
                        v-if="homeowners.length"
                        :data="homeowners"
                        @export="exportHomeowners"
                        title="Homeowners"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DynamicTable from '@/Components/DynamicTable.vue';

interface FormData {
    file: File | null;
}

const fileInput = ref<HTMLInputElement | null>(null);

const form = useForm<FormData>({
    file: null,
});

const homeowners = ref([]);

const submitForm = () => {
    form.post('/homeowners/upload', {
        onSuccess: (response) => {
            if (fileInput.value) {
                fileInput.value.value = '';
            }
        },
        preserveScroll: true,
    });
};

const exportHomeowners = (data) => {
    console.log('Exporting data:', data);
};
</script>
