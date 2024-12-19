<template lang="es">
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Iniciar sesión</h4>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="handleLogin()">
                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Usuario</label>
                                    <input
                                        type="text"
                                        id="usuario"
                                        v-model="use.usuario"
                                        class="form-control"
                                        placeholder="Ingrese su usuario"
                                        required
                                    />
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input
                                        type="password"
                                        id="password"
                                        v-model="use.password"
                                        class="form-control"
                                        placeholder="Ingrese su contraseña"
                                        required
                                    />
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div
                id="liveToast"
                class="toast"
                role="alert"
                aria-live="assertive"
                aria-atomic="true"
                :class="{ show: showToastMessage }"
                ref="toast"
            >
                <div class="toast-header" style="background:red;color:white">
                    <strong class="me-auto">Notificacón</strong>
                    <!-- <small>11 mins ago</small> -->
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="toast"
                        aria-label="Close"
                        @click="hideToast"
                        style="color:white"
                    ></button>
                </div>
                <div class="toast-body">
                    Usuario o contraseña no validos
                </div>
            </div>
        </div>
    </main>
</template>

<script>

export default {
    name: 'Login',    

    data() {
        return {
            use:{
                usuario:"",
                password:""
            },
            showToastMessage: false

        };
    },
    methods: {
       async handleLogin() {
        await this.axios.post('/api/usuario/verificar',this.use).then(response=>{
                console.log(response.data.usuario)
                localStorage.setItem('user',JSON.stringify(response.data.usuario));
                
                if(response.data.usuario?.usuario == 'os'){
                    
                    this.$router.push({ path: '/inicio' })
                }else{
                    
                    this.$router.push({ path: '/tabla' })
                }
            }).catch(error=>{
                console.log(error)
                this.showToast()
            });
        },
        showToast() {
            this.showToastMessage = true;

            const toastElement = this.$refs.toast;
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
            setTimeout(() => {
                this.showToastMessage = false;
            }, 3000);
        },
        hideToast() {
            this.showToastMessage = false;
        }

    }
}
</script>

<style scoped>
/* Personalización del estilo si es necesario */
</style>
