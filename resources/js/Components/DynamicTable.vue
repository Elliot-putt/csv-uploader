<template>
    <div class="card shadow-sm mt-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0"> {{ props.title }}</h5>
            <a  class="btn btn-primary" :href="props.exportLink" :disabled="!data.length" download>
                <i class="fas fa-download me-2"></i>
                Export Data</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th
                            v-for="header in headers"
                            :key="header"
                            scope="col"
                            class="px-4 py-3"
                        >
                            {{ formatHeader(header) }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="!data.length">
                        <td
                            :colspan="headers.length"
                            class="text-center py-4"
                        >
                            No data available
                        </td>
                    </tr>
                    <tr
                        v-for="(row, index) in data"
                        :key="index"
                    >
                        <td
                            v-for="header in headers"
                            :key="header"
                            class="px-4 py-3"
                        >
                            {{ row[header] }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';

interface Props {
    data: Record<string, any>[];
    title: Record<string, any>;
    exportLink: Record<string, any>;
}

const props = defineProps<Props>();

const headers = computed(() => {
    if (!props.data.length) return [];
    return Object.keys(props.data[0]);
});

const formatHeader = (header: string): string => {
    return header
        .split(/[_\s]|(?=[A-Z])/)
        .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
        .join(' ');
};
</script>

<style scoped>
.table {
    color: var(--text-primary);
}

.table th {
    font-weight: 600;
    white-space: nowrap;
    background-color: var(--dark-surface);
    color: var(--text-primary);
    border-bottom: 1px solid var(--border-color);
}

.table td {
    vertical-align: middle;
    border-color: var(--border-color);
    color: black;
}

.table tbody tr:hover {
    background-color: rgba(108, 99, 255, 0.05) !important;
}

.card-header {
    background-color: var(--dark-surface);
    border-bottom: 1px solid var(--border-color);
}

.table-responsive {
    scrollbar-width: thin;
    scrollbar-color: var(--primary-purple) var(--dark-surface);
}

.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: var(--dark-surface);
}

.table-responsive::-webkit-scrollbar-thumb {
    background-color: var(--primary-purple);
    border-radius: 4px;
}
</style>
