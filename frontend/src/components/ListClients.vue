<template>
  <div class="hello">
    <h2>Clientes</h2>
    <router-link :to="`/`">Voltar</router-link>
    <br>
    <router-link :to="`/clients/create`">Novo</router-link>
    <div class="container">
      <b-row>
        <b-col>
          Lista Clientes
            <b-table striped hover :items="data" :fields="fields">
              <template v-slot:cell(acoes)="row">
                <b-button size="sm" @click="address(row.item)" class="mr-2">
                  Endereço
                </b-button>
                <b-button size="sm" @click="edit(row.item)" class="mr-2">
                  Editar
                </b-button>
                <b-button size="sm" @click="deleteUser(row.item)" class="mr-2 btn btn-danger">
                  Excluir
                </b-button>
              </template>
            </b-table>
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
        {key: 'id', label: '#id'},
        {key: 'nome', label: 'Nome'},
        {key: 'datanascimento', label: 'Nascimento'},
        {key: 'cpf', label: 'CPF'},
        {key: 'rg', label: 'RG'},
        {key: 'telefone', label: 'Telefone'},
        {key: 'acoes', label: 'Ações'}
      ]
    }
  },
  mounted () {
    this.dataList()
  },
  methods: {
    async dataList () {
      try {
        const response = await api.get('clients')
        this.data = response.data
      } catch (error) {
        console.log(error)
      }
    },
    async address (row) {
      let id = row.id
      this.$router.push({ name: 'AddressClient', params: { id } })
    },
    async edit (row) {
      let id = row.id
      this.$router.push({ name: 'EditClient', params: { id } })
    },
    async deleteUser (row) {
      let id = row.id

      try {
        if (confirm('Tem certeza que deseja excluir o registro?')) {
          const response = await api.get(`clients/delete?id=${id}`)
          alert(response.data)
          window.location.reload()
        }
      } catch (e) {
        alert(e.response.data.erro + ',' + e.response.data.error)
      }
    }
  }
}
</script>
