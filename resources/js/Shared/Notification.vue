<template>
    <div v-show="page.props?.flash?.success" class="notification">
        <div :class="['toast show slide-in' , page?.props?.flash?.success ? 'bg-success' : 'bg-danger']">
            <div class="toast-body">
                <span>{{ page?.props?.flash?.success }} </span>
                <i class="fa-solid fa-xmark text-white" style="cursor:pointer;" @click="close"></i>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { watch } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const close = () => {
    window.location.reload();
};

watch(() => page.props?.flash?.success, (message) => {
    if (message) {
        setTimeout(() => {
            window.location.reload();
        }, 5000);
    }
});
</script>

<style scoped>
.notification {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 1050;
}

.toast {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: #fff;
    border: none;
}

.toast-body {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
}

.btn-close {
    background: none;
    border: none;
    color: white;
    font-size: 1rem;
    cursor: pointer;
    filter: invert(1);
}

@keyframes slide-in {
    0% { transform: translateX(100%) rotate(0deg); }
    80% { transform: translateX(0) rotate(3deg); }
    90% { transform: rotate(-3deg); }
    100% { transform: rotate(0deg); }
}

.slide-in {
    animation: slide-in 0.5s ease;
}
</style>
