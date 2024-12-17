<template lang="es">
    <main>
        <Navbar />
        <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 text-center">
                <!-- Zona de Drag and Drop -->
                <div
                    @dragover.prevent
                    @drop.prevent="handleDrop"
                    @click="triggerFileInput"
                    class="border p-5 rounded d-flex justify-content-center align-items-center"
                    style="height: 200px; cursor: pointer;"
                >
                    <input
                        ref="fileInput"
                        type="file"
                        accept=".csv,.xlsx"
                        style="display: none"
                        @change="handleFileChange"
                        name="archivo"
                    />
                    <div>
                        <p v-if="!fileName">Arrastra y suelta un archivo CSV aquí o haz clic para seleccionar</p>
                        <p v-else>Archivo cargado: {{ fileName.name }}</p>
                    </div>
                </div>
                <!-- Mensaje de error -->
                <div v-if="errorMessage" class="mt-3 alert alert-danger">
                    {{ errorMessage }}
                </div>
            </div>
            <div class="col-md-12"></div>
            <br>
            <br>
            <div class="col-md-6 col-lg-4 text-center">
                <!-- Zona de Drag and Drop -->
                 <button class="btn btn-success" @click="guardar">Guardar</button>
            </div>

        </div>
    </div>
    </main>
    
</template>

<script>
// import * as XLSX from 'xlsx';
import Navbar from "./Navbar.vue";

export default {
    name: "FileUpload",
    components: {
        Navbar
    },

    data() {
        return {
            errorMessage: "",
            fileName:null,
        };
    },
    methods: {
        // Manejar archivo cuando se hace click
        triggerFileInput() {
            this.$refs.fileInput.click();
        },

        // Manejar archivo cuando se suelta
        handleDrop(event) {
            const file = event.dataTransfer.files[0];
            this.fileName = event.dataTransfer.files[0];
            this.processFile(file);
        },

        // Manejar archivo cuando se selecciona
        handleFileChange(event) {
            const file = event.target.files[0];
            this.fileName = event.target.files[0];
            this.processFile(file);
        },

        // Procesar archivo
        processFile(file) {
            this.errorMessage = ""; // Limpiar mensaje de error

            // Validar que el archivo sea .xlsx
            if (!file.name.endsWith(".csv")) {
                this.fileName = null
                this.errorMessage = "Por favor, selecciona un archivo con extensión .csv";
                return;
            }

            // Leer el archivo Excel usando la librería xlsx
            // const reader = new FileReader();
            // reader.onload = (e) => {
            //     const data = new Uint8Array(e.target.result);
            //     const workbook = XLSX.read(data, { type: "array" });

            //     // Aquí puedes trabajar con los datos del archivo
            //     console.log(workbook);
            // };
            // reader.readAsArrayBuffer(file);
        },
        async guardar(){
            console.log(this.fileName)
            // await this.axios.post('/api/usuario/cargarExcel',{
            //     archivo:this.fileName
            // }).then(response=>{
            //     console.log(response)
            //     // this.$router.push({ path: '/blogs' })
            // }).catch(error=>{
            //     console.log(error)
            // });

            try {
                const formData = new FormData();
                formData.append("archivo", this.fileName);

                // Llamada al endpoint
                const response = await axios.post("/api/usuario/cargarExcel", formData, 
                {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
                }
                );

                console.log("Archivo subido exitosamente:", response.data);
                alert("Archivo subido exitosamente.");
            } catch (error) {
                console.error("Error al subir el archivo:", error);
                this.errorMessage = "Hubo un error al subir el archivo. Intenta de nuevo.";
            }
        },

    }
};
</script>

<style scoped>
/* Estilos opcionales */
</style>
