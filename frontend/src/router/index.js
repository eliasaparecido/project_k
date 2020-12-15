import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import ListUsers from '@/components/ListUsers'
import CreateUser from '@/components/CreateUser'
import EditUser from '@/components/EditUser'
import ListClients from '@/components/ListClients'
import CreateClient from '@/components/CreateClient'
import EditClient from '@/components/EditClient'
import AddressClient from '@/components/AddressClient'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Index',
      component: Index
    },
    {
      path: '/users',
      name: 'ListUsers',
      component: ListUsers
    },
    {
      path: '/users/create',
      name: 'CreateUser',
      component: CreateUser
    },
    {
      path: '/users/edit/:id',
      name: 'EditUser',
      component: EditUser
    },
    {
      path: '/clients',
      name: 'ListClients',
      component: ListClients
    },
    {
      path: '/clients/create',
      name: 'CreateClient',
      component: CreateClient
    },
    {
      path: '/clients/edit/:id',
      name: 'EditClient',
      component: EditClient
    },
    {
      path: '/clients/address/:id',
      name: 'AddressClient',
      component: AddressClient
    }
  ]
})
