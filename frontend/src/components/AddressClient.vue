<template>
  <div class="hello">
    <h2>Endereços do Cliente: {{client.nome}}</h2>
    <router-link :to="`/clients`">Voltar</router-link>
    <br>
    <div class="container">
      <b-row>
        <b-col class="col-sm-12 col-md-12 col-lg-12">
          Cadastrar novo endereço
          <form action="#" @submit.prevent="save()">
            <label for= "tipo">Tipo Endereço</label>
            <input type="text" v-model="address.tipo" class="form-control" name="tipo" required="required">
            <label for= "name">Endereço</label>
            <input type="text" v-model="address.endereco" class="form-control" name="endereco" required="required">
            <label for= "bairro">Bairro</label>
            <input type="text" v-model="address.bairro" class="form-control" name="bairro" required="required">
            <label for= "cidade">Cidade</label>
            <input type="text" v-model="address.cidade" class="form-control" name="cidade" required="required">
            <label for= "estado">Estado</label>
            <input type="text" v-model="address.estado" class="form-control" name="estado" required="required">
            <br>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </form>
        </b-col>
        <b-col class="col-sm-12 col-md-12 col-lg-12">
          <br>
          Lista de Endereços
          <b-table v-if="addressList.length > 0" striped hover :items="addressList" :fields="fields">
              <template v-slot:cell(acoes)="row">
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
      client: [{
        nome: '',
        datanascimento: '',
        cpf: '',
        rg: '',
        telefone: ''
      }],
      addressList: [{
        tipo: '',
        endereco: '',
        bairro: '',
        cidade: '',
        estador: ''
      }],
      address: [{
        tipo: '',
        endereco: '',
        bairro: '',
        cidade: '',
        estador: ''
      }],
      fields: [
        {key: 'id', label: '#id'},
        {key: 'tipo', label: 'Tipo'},
        {key: 'endereco', label: 'Endereço'},
        {key: 'bairro', label: 'Bairro'},
        {key: 'cidade', label: 'Cidade'},
        {key: 'estado', label: 'Estado'},
        {key: 'acoes', label: 'Ações'}
      ]
    }
  },
  async created () {
    const response = await api.get(`clients/edit?id=${this.$route.params.id}`)
    this.client = response.data

    const resp = await api.get(`clients/address?id=${this.$route.params.id}`)
    this.addressList = resp.data
  },
  methods: {
    save () {
      api.post(`clients/address/create?id=${this.client.id}`,
        {
          client_id: this.client.id,
          tipo: this.address.tipo,
          endereco: this.address.endereco,
          bairro: this.address.bairro,
          estado: this.address.estado,
          cidade: this.address.cidade
        }
      ).then((resp) => {
        alert(resp.data.Sucesso)
        window.location.reload()
      }).catch((e) => {
        console.log(e.response)
        alert(e.response.data.erro + ',' + e.response.data.error)
        this.created()
      })
    },
    async deleteUser (row) {
      let id = row.id

      try {
        if (confirm('Tem certeza que deseja excluir o registro?')) {
          const response = await api.get(`clients/address/delete?id=${id}`)
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
