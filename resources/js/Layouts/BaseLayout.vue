<template>
    <div class="container">
        <header>
            <h1 class="title">Hacker News Scraper</h1>
            <button @click="logout" class="logoutBtn">Logout</button>
        </header>

        <main>
            <slot></slot>
        </main>
    </div>
</template>

<script setup>
    import {router} from '@inertiajs/vue3';

    const logout = () => {
        router.post('/logout');
    };
</script>

<style>
    container {
  display: flex;
  flex-direction: column;
  align-items: center; 
}

header {
  display: flex;
  justify-content: space-between; 
  width: 95%;
  padding: 2rem;
  margin: 2rem;
  background-color: blanchedalmond;
  border-radius: 15px;
  border-bottom: 1px solid #ccc;
  margin: auto;
}

main{
  display: flex;
  margin: auto;
  justify-content: center;
  align-items: center;
}

.title {
  margin: 0 auto;
  font-size: 2rem;
}

.logoutBtn {
  background-color: rgb(255, 67, 67);
  border-radius: 7px;
  border: 1px black solid;
  padding: 3px;
  font-weight: bold;
  font-size: 1.5rem;
}
</style>
