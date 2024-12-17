<template lang="es">
       <main>
        <Navbar />
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12 mt-3 mb-4">
                    <!-- <router-link :to="{name:crearBlogs}" class="btn btn-success">Nuevo  </router-link> -->
                    <router-link v-if="user.usuario == 'os'" to="/inicio" class="btn btn-success"> <i class="fas fa-arrow-left"></i> </router-link>
                </div>
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>PATERNO</th>
                                <th>MATERNO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="blog in blogs" :key="blog.id">
                                <td> {{ blog.id }} </td>
                                <td> {{ blog.nombre }} </td>
                                <td> {{ blog.paterno }} </td>
                                <td> {{ blog.materno }} </td>
                                <td>
                                    <a type="button" @click="abrirModal(blog)" class="btn btn-warning"><i class="fas fa-bullseye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
          <!-- Modal -->
          <div v-if="mostrarModal" class="modal-overlay container">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Información</h5>
        <button type="button" class="btn-close" @click="cerrarModal"></button>
      </div>
      <div class="modal-body">
        
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    lista de direcciones
                    <ul>
                        <li v-for="(item, index) in mos.direcciones" :key="index">
                        <strong>Direccion: </strong> {{ item.calle }} {{ item.numero_interior }} {{item.colonia}} {{ item.cp }} <br>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    lista de telefonos
                    <ul>
                        <li v-for="(item, index) in mos.telefonos" :key="index">
                        <strong>Telefono: </strong> {{ item.telefono }} <br>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cancelar</button>
      </div>
    </div>
  </div>       

</main>

</template>
<script>
import Navbar from "../Navbar.vue";

export default {
    name:'Mostrar',
    components: {
        Navbar
  },

    data(){
        return{
            blogs:[],
            mostrarModal:false,
            mos:null,
            user:{}
        }
    },
    mounted(){
        this.mostrarBlogs();
    },
    methods:{
        async mostrarBlogs(){
            await this.axios.get('/api/persona').then(response=>{
                // console.log(response)
                this.blogs = response.data;
            }).catch(error=>{
                console.log(error)
                this.blogs=[];
            });
            let usuarioGuardado = JSON.parse(localStorage.getItem('user'));
            this.user = usuarioGuardado
            // console.log(this.user)

        },
        abrirModal(item) {
            console.log(item)
            this.mos = null
            this.mos = item
      this.mostrarModal = true; // Mostramos el modal
    },

    cerrarModal() {
      this.mostrarModal = false; // Ocultamos el modal
    },

    }
}
</script>
<style lang="">
    
</style>