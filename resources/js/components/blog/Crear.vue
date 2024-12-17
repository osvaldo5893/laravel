<template lang="es">
    <div>
        <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Blog</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="crear()">

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
    name:'Crear',
    data(){
        return{
            blog:{
                titulo:"",
                contenido:""
            }
        }
    },
    methods:{
        async crear(){
            await this.axios.post('/api/blog',this.blog).then(response=>{
                // console.log(response)
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