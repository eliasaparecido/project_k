<template>
  <div class="hello">
    <h2>Página Inicial</h2>
    <router-link :to="`users`">Usuários</router-link>
    <br>
    <router-link :to="`clients`">Clientes</router-link>
  </div>
</template>

<script>

export default {
  data () {
    return {
    }
  },
  methods: {
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #424ab9;
}
</style>
