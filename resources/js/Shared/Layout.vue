<template>
    <Head>
        <title>Home</title>
        <meta type="description" content="Homeowner csv converter" head-key="description">
    </Head>
    <div class="app-container">
        <Notification />
                <slot/>
    </div>
</template>

<script setup>


import Notification from "@/Shared/Notification.vue";
</script>
