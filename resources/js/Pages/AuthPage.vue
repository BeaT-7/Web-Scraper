<template>
    <AuthLayout>
        <div v-if="formType === 'login'">
            <LoginFormComponent />
        </div>

        <div v-if="formType === 'register'">
            <RegisterFormComponent />
        </div>

        <button @click="toggleForm"
            class="toggle-btn">{{ formType === 'login' ? 'Switch to Register' : 'Switch to Login' }}</button>
    </AuthLayout>
</template>

<script setup>
    import {
        ref
    } from 'vue';
    import AuthLayout from '../Layouts/AuthLayout.vue';
    import LoginFormComponent from '../Components/Auth/LoginFormComponent.vue';
    import RegisterFormComponent from '../Components/Auth/RegisterFormComponent.vue';

    const formType = ref('login');

    const toggleForm = () => {
        formType.value = formType.value === 'login' ? 'register' : 'login';
    };
</script>

<style scoped>
    .toggle-btn {
        margin-top: 1rem;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        width: 50%;
    }

    .toggle-btn:hover {
        background-color: #0056b3;
    }
</style>
