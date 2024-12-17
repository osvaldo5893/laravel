<template lang="es">
    <div>
        <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Blog</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="actualizar()">

                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Titutlo" v-model="blog.titulo">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="mb-3">
                                    <textarea class="form-control" rows="3" v-model="blog.contenido"></textarea>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</template>
<script>
export default {
    name:'Editar',
    data(){
        return{
            blog:{
                titulo:"",
                contenido:"",
            }
        }
    },
    mounted(){
        this.mostrarBlog()
    },
    methods:{
        async mostrarBlog(){
            
            await this.axios.get('/api/blog/'+this.$route.params.id).then(response=>{
                const {titulo,contenido} = response.data.blog;
                this.blog.titulo = titulo
                this.blog.contenido = contenido
            }).catch(error=>{
                console.log(error)
                this.blogs=[];
            });

        },
        async actualizar(){
            await this.axios.put('/api/blog/'+this.$route.params.id,this.blog).then(response=>{
                this.$router.push({ path: '/blogs' })
            }).catch(error=>{
                console.log(error)
                this.blogs=[];
            });
        },
    }
}
</script>
<style lang="">
    
</style>