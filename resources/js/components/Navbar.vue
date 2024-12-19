<template lang="">
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><svg class="logo" viewBox="0 0 128 128" width="24" height="24" data-v-e9cb7cd5=""><path fill="#42b883" d="M78.8,10L64,35.4L49.2,10H0l64,110l64-110C128,10,78.8,10,78.8,10z" data-v-e9cb7cd5=""></path><path fill="#35495e" d="M78.8,10L64,35.4L49.2,10H25.6L64,76l38.4-66H78.8z" data-v-e9cb7cd5=""></path></svg></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item" v-if="user && user.usuario === 'os'">
          <router-link exact-active-class="active" to="/inicio" class="nav-link" aria-current="page">Carga de archivo</router-link>
        </li>
        <li class="nav-item">
            <router-link exact-active-class="active" to="/tabla" class="nav-link" aria-current="page">Tabla</router-link>
        </li>
      </ul>
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>
    </div>
</template>
<script>
export default {
    name:'Navbar',
    data(){
        return{
          user:null
        }
    },
    mounted(){
        this.mostrarBlogs();
    },
    methods:{
        async mostrarBlogs() {
          const usuarioGuardado = localStorage.getItem('user');
          if (usuarioGuardado) {
                try {
                    this.user = JSON.parse(usuarioGuardado);
                    console.log("Desde Navbar:", this.user.usuario);
                } catch (error) {
                    console.error("El dato guardado en 'user' no es un JSON válido:", error);
                }
          } else {
              console.error("No se encontró un usuario en localStorage.");
          }
        }


    }
}
</script>
<style lang="">
    
</style>