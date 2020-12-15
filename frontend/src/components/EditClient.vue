<template>
  <div class="hello">
    <h2>Cadastro de Cliente</h2>
    <router-link :to="`/clients`">Voltar</router-link>
    <br>
    <div class="container">
      <b-row>
        <b-col class="col-sm-12 col-md-12 col-lg-6">
          <form action="#" @submit.prevent="save()">
            <label for= "name">Nome</label>
            <input type="text" v-model="client.nome" class="form-control" name="nome" required="required">
            <label for= "datanascimento">Data Nascimento</label>
            <input type="date" v-model="client.datanascimento" class="form-control" name="datanascimento" required="required">
            <label for= "cpf">CPF</label>
            <input type="text" v-model="client.cpf" class="form-control" name="cpf" required="required">
            <label for= "rg">RG</label>
            <input type="text" v-model="client.rg" class="form-control" name="rg" required="required">
            <label for= "telefone">Telefone</label>
            <input type="text" v-model="client.telefone" class="form-control" name="telefone" required="required">
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
      client: [{
        nome: '',
        datanascimento: '',
        cpf: '',
        rg: '',
        telefone: ''
      }]
    }
  },
  async created () {
    const response = await api.get(`clients/edit?id=${this.$route.params.id}`)
    this.client = response.data
  },
  methods: {
    save () {
      api.post(`clients/update?id=${this.client.id}`,
        {
          nome: this.client.nome,
          datanascimento: this.client.datanascimento,
          cpf: this.client.cpf,
          rg: this.client.rg,
          telefone: this.client.telefone
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
