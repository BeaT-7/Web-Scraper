<template>
    <div class="auth-page">
        <h1 class="auth-title">Hacker News Scraper</h1>

        <div class="auth-form">
            <slot></slot>
        </div>
    </div>
</template>

<script setup></script>

<style scoped>
    .auth-page {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-color: #f3f4f6;
    }

    .auth-title {
        font-size: 2rem;
        margin-bottom: 2rem;
        color: #333;
    }

    .auth-form {
        width: 300px;
        padding: 20px;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
