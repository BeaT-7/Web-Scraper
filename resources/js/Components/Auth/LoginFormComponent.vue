<template>
    <form class="auth-form" @submit.prevent="submit">
        <h2 class="form-title">Login</h2>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" v-model="form.email" required />
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" v-model="form.password" required />
        </div>

        <button type="submit" class="submit-btn">Login</button>
    </form>
</template>

<script setup>
    import {
        reactive
    } from 'vue'
    import {
        router
    } from '@inertiajs/vue3'

    const form = reactive({
        email: null,
        password: null,
    })

    function submit() {
        router.post('/login', form)
    }
</script>

<style scoped>
    .auth-form {
        width: 100%;
        max-width: 400px;
        border-radius: 8px;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
    }

    input {
        width: 90%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .submit-btn {
        display: block;
        width: 50%;
        padding: 0.5rem;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        margin-inline: auto;

    }

    .submit-btn:hover {
        background-color: #0056b3;
    }
    .form-title{
        display: block;
        text-align: center;
    }
</style>
