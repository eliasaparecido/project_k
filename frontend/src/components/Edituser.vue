<template>
  <div class="hello">
    <h2>Editar Usuário</h2>
    <router-link :to="`/users`">Voltar</router-link>
    <br>
    <div class="container">
      <b-row>
        <b-col class="col-sm-12 col-md-12 col-lg-6">
          <form action="#" @submit.prevent="save()">
            <label for= "name">Nome</label>
            <input type="text" v-model="user.name" class="form-control" name="name" required="required">
            <label for= "name">E-mail</label>
            <input type="email" v-model="user.email" class="form-control" name="email"  required="required">
            <label for= "password">Senha</label>
            <input type="password" v-model="user.password" class="form-control" name="email"  required="required">
            <br>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </form>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import api from '../router/api'

export default {
  data () {
    return {
      data: [],
      carregando: true,
      fields: [
        {key: 'name', label: 'Nome'}
      ],
      user: [{
        id: '',
        name: '',
        email: '',
        password: ''
      }]
    }
  },
  async created () {
    const response = await api.get(`users/edit?id=${this.$route.params.id}`)
    this.user = response.data
  },
  methods: {
    save () {
      api.post(`users/update?id=${this.user.id}`,
        {
          name: this.user.name,
          email: this.user.email,
          password: this.user.password
        }
      ).then((resp) => {
        console.log(resp.data.sucesso)
        alert(resp.data.Sucesso)
      }).catch((e) => {
        console.log(e.response)
        alert(e.response.data.erro + ',' + e.response.data.error)
      })
    }
  }
}
</script>
