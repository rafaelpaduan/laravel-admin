<template>
  <div class="row">
    <h3>Esse é o Index!</h3>
    <p>A Rota atual é {{ $nuxt.$route.name }}</p>
  </div>
</template>

<script>
export default {
  name: 'IndexPage'
}
</script>
